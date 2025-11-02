<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'conexion.php'; 

// Verificar que el carrito no esté vacío
if (empty($_SESSION['carrito'])) {
    die("Error: El carrito está vacío.");
}

// Credenciales de Paypal Sandbox
$clientID = "AU7lmsfWwJe2kVfcXx7t0MNW0zHXwCuo5bLC08saSVpw5VBDPIYGsVZeXohv8BQ9AJUr-YwRU_cqp5s6";
$secret   = "ECNowaQ3_70PTk0KnDjHBJtPaYIANXf3PyD1Z6cBp7pwVK-SfzJhqym-Kn_UXbfnm8wkK6qsNdMHELW0";
$paypalAPI = "https://api-m.sandbox.paypal.com";

// Calcular total
$total_a_pagar = 0.0;
$product_ids = array_keys($_SESSION['carrito']);
$placeholders = implode(',', array_fill(0, count($product_ids), '?'));

$sql = "SELECT id, precio FROM productos WHERE id IN ($placeholders)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param(str_repeat('i', count($product_ids)), ...$product_ids);
$stmt->execute();
$resultado = $stmt->get_result();

while ($producto = $resultado->fetch_assoc()) {
    $cantidad = $_SESSION['carrito'][$producto['id']]['cantidad'];
    $total_a_pagar += $producto['precio'] * $cantidad;
}
$stmt->close();
$conexion->close();

// Token de acceso
$ch_token = curl_init();
curl_setopt($ch_token, CURLOPT_URL, "$paypalAPI/v1/oauth2/token");
curl_setopt($ch_token, CURLOPT_USERPWD, "$clientID:$secret");
curl_setopt($ch_token, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch_token, CURLOPT_HTTPHEADER, ['Accept: application/json']);
curl_setopt($ch_token, CURLOPT_RETURNTRANSFER, true);
$response_token = curl_exec($ch_token);
curl_close($ch_token);

$data_token = json_decode($response_token);
if (!isset($data_token->access_token)) {
    die("Error de autenticación con PayPal.");
}
$accessToken = $data_token->access_token;

// Crear orden de pago
$url_base = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname($_SERVER['PHP_SELF'])), '/\\');

$orderData = [
    'intent' => 'CAPTURE',
    'purchase_units' => [[
        'amount' => [
            'currency_code' => 'MXN',
            'value' => number_format($total_a_pagar, 2, '.', '')
        ]
    ]],
    'application_context' => [
        'return_url' => $url_base . '/php/procesar_pedido.php',
        'cancel_url' => $url_base . '/comprar.php?status=cancelled'
    ]
];

$ch_order = curl_init();
curl_setopt($ch_order, CURLOPT_URL, "$paypalAPI/v2/checkout/orders");
curl_setopt($ch_order, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
]);
curl_setopt($ch_order, CURLOPT_POST, true);
curl_setopt($ch_order, CURLOPT_POSTFIELDS, json_encode($orderData));
curl_setopt($ch_order, CURLOPT_RETURNTRANSFER, true);
$response_order = curl_exec($ch_order);
curl_close($ch_order);

$data_order = json_decode($response_order);

if (!isset($data_order->id) || !isset($data_order->links)) {
    die("Error al crear la orden de PayPal.");
}

// Redireccionar al usuario a pagar
$approve_url = null;
foreach ($data_order->links as $link) {
    if ($link->rel == 'approve') {
        $approve_url = $link->href;
        break;
    }
}

if ($approve_url) {
    header("Location: " . $approve_url);
    exit();
} else {
    die("No se pudo encontrar la URL de aprobación de PayPal.");
}
?>