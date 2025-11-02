<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'conexion.php'; 

// Credenciales de Paypal Sandbox
$clientID = "AU7lmsfWwJe2kVfcXx7t0MNW0zHXwCuo5bLC08saSVpw5VBDPIYGsVZeXohv8BQ9AJUr-YwRU_cqp5s6";
$secret   = "ECNowaQ3_70PTk0KnDjHBJtPaYIANXf3PyD1Z6cBp7pwVK-SfzJhqym-Kn_UXbfnm8wkK6qsNdMHELW0";
$paypalAPI = "https://api-m.sandbox.paypal.com";

$orderID = $_GET['token'] ?? null;
$payerID = $_GET['PayerID'] ?? null;

if (!$orderID || !$payerID || empty($_SESSION['carrito'])) {
    die("Error: Faltan parámetros para procesar el pedido.");
}

// Token de acceso
$ch_token = curl_init();
curl_setopt($ch_token, CURLOPT_URL, "$paypalAPI/v1/oauth2/token");
curl_setopt($ch_token, CURLOPT_USERPWD, "$clientID:$secret");
curl_setopt($ch_token, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch_token, CURLOPT_RETURNTRANSFER, true);
$response_token = curl_exec($ch_token);
curl_close($ch_token);
$data_token = json_decode($response_token);
if (!isset($data_token->access_token)) {
    die("Fallo de autenticación con PayPal.");
}
$accessToken = $data_token->access_token;

// Capturar el pago
$ch_capture = curl_init();
curl_setopt($ch_capture, CURLOPT_URL, "$paypalAPI/v2/checkout/orders/$orderID/capture");
curl_setopt($ch_capture, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
]);
curl_setopt($ch_capture, CURLOPT_POST, true);
curl_setopt($ch_capture, CURLOPT_RETURNTRANSFER, true);

$response_capture = curl_exec($ch_capture);
curl_close($ch_capture);

$captureDetails = json_decode($response_capture);

// Verificar que la captura fue exitosa
if (!$captureDetails || !isset($captureDetails->status) || $captureDetails->status !== 'COMPLETED') {
    $_SESSION['error_compra'] = "Pago no completado. Estado: " . ($captureDetails->status ?? 'N/A');
    header('Location: ../gracias.php?status=error');
    exit();
}

$conexion->begin_transaction();
try {
    $carrito = $_SESSION['carrito'];
    
    // Verificacion de usuario (si es invitado se deja nulo)
    $usr_id = $_SESSION['id_usuario'] ?? null; 

    $product_ids = array_keys($carrito);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

    // Verificar stock
    $stmt_stock = $conexion->prepare("SELECT id, stock, precio FROM productos WHERE id IN ($placeholders) FOR UPDATE");
    $stmt_stock->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
    $stmt_stock->execute();
    $res_stock = $stmt_stock->get_result();

    $productos_db = [];
    $stock_suficiente = true;
    $total_final_seguro = 0.0; 
    
    while ($fila = $res_stock->fetch_assoc()) {
        $productos_db[$fila['id']] = $fila;
    }

    foreach ($carrito as $prod_id => $item) {
        $cantidad_pedido = $item['cantidad'];
        if (!isset($productos_db[$prod_id]) || $productos_db[$prod_id]['stock'] < $cantidad_pedido) {
            $stock_suficiente = false;
            break;
        }
        $total_final_seguro += $productos_db[$prod_id]['precio'] * $cantidad_pedido;
    }

    if (!$stock_suficiente) throw new Exception("Stock insuficiente.");

    // Insertar orden
    $metodo_pago = 'paypal';
    $stmt_order = $conexion->prepare("INSERT INTO pedidos (id_usuario, total, metodo_pago, fecha) VALUES (?, ?, ?, NOW())");
    $stmt_order->bind_param("ids", $usr_id, $total_final_seguro, $metodo_pago);
    $stmt_order->execute();
    $new_ord_id = $conexion->insert_id; 

    // Detaalles y stock
    $stmt_details = $conexion->prepare("INSERT INTO detalles_pedido (id_pedido, id_producto, nombre_producto, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
    $stmt_update_stock = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");

    foreach ($carrito as $prod_id => $item) {
        $stmt_details->bind_param("iisdi", 
            $new_ord_id, $prod_id, $item['nombre'], $item['precio'], $item['cantidad']
        );
        $stmt_details->execute();

        $stmt_update_stock->bind_param("ii", $item['cantidad'], $prod_id);
        $stmt_update_stock->execute();
    }

    $conexion->commit();
    
    // Vaciar el carrito
    unset($_SESSION['carrito']); 
    
    $_SESSION['last_order_id'] = $new_ord_id; 

    header('Location: ../gracias.php?status=success');

} catch (Exception $e) {
    $conexion->rollback(); 
    $_SESSION['error_compra'] = "Error al guardar el pedido: " . $e->getMessage();
    header('Location: ../gracias.php?status=error');
}

$conexion->close();
exit();
?>