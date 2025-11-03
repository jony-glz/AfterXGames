<?php
session_start();
require 'conexion.php'; // <- CORREGIDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id']) || !isset($_POST['action'])) {
        header("Location: ../carritow.php");
        exit;
    }

    $id_producto = intval($_POST['id']);
    $action = $_POST['action'];

    if (!isset($_SESSION['carrito'][$id_producto])) {
        header("Location: ../carritow.php");
        exit;
    }

    switch ($action) {
        case 'update':
            if (!isset($_POST['cantidad'])) break;

            $nueva_cantidad = intval($_POST['cantidad']);
            if ($nueva_cantidad <= 0) {
                unset($_SESSION['carrito'][$id_producto]);
                break;
            }

            $stmt = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $producto = $resultado->fetch_assoc();
                $stock_disponible = $producto['stock'];

                if ($nueva_cantidad > $stock_disponible) {
                    $_SESSION['mensaje_carrito'] = "¡Stock insuficiente! Solo quedan " . $stock_disponible . " unidades de " . $_SESSION['carrito'][$id_producto]['nombre'];
                    $_SESSION['carrito'][$id_producto]['cantidad'] = $stock_disponible;
                } else {
                    $_SESSION['carrito'][$id_producto]['cantidad'] = $nueva_cantidad;
                }
            }
            $stmt->close();
            break;

        case 'delete':
            unset($_SESSION['carrito'][$id_producto]);
            break;
    }
}

$conexion->close();
header("Location: ../carritow.php");
exit;
?>
