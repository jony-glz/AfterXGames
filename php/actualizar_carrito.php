<?php
session_start();
require 'conexion.php'

// Verificamos que se envió un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verificamos que tenemos los datos mínimos
    if (!isset($_POST['id']) || !isset($_POST['action'])) {
        header("Location: ../carritow.php");
        exit;
    }

    $id_producto = $_POST['id'];
    $action = $_POST['action'];

    // Si el producto no existe en el carrito, no hacer nada
    if (!isset($_SESSION['carrito'][$id_producto])) {
        header("Location: ../carritow.php");
        exit;
    }

    // Usamos un switch para manejar las diferentes "acciones"
    switch ($action) {
        
        // Caso 1: El usuario quiere ACTUALIZAR la cantidad
        case 'update':
            if (!isset($_POST['cantidad'])) {
                break; // Salir si no se envió la cantidad
            }
            
            $nueva_cantidad = intval($_POST['cantidad']);

            // Validación 1: No permitir 0 o menos
            if ($nueva_cantidad <= 0) {
                // Si ponen un número inválido, lo mejor es eliminar el producto
                unset($_SESSION['carrito'][$id_producto]);
                break;
            }

            // Validación 2: Verificar el STOCK (¡Importante!)
            $stmt = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows > 0) {
                $producto = $resultado->fetch_assoc();
                $stock_disponible = $producto['stock'];

                if ($nueva_cantidad > $stock_disponible) {
                    // Si piden más de lo que hay, poner un mensaje de error
                    $_SESSION['mensaje_carrito'] = "¡Stock insuficiente! Solo quedan " . $stock_disponible . " unidades de " . $_SESSION['carrito'][$id_producto]['nombre'];
                    // Y ajustamos la cantidad al máximo disponible
                    $_SESSION['carrito'][$id_producto]['cantidad'] = $stock_disponible;
                } else {
                    // Si hay stock, simplemente actualizamos la cantidad
                    $_SESSION['carrito'][$id_producto]['cantidad'] = $nueva_cantidad;
                }
            }
            $stmt->close();
            break;

        // Caso 2: El usuario quiere ELIMINAR el producto
        case 'delete':
            unset($_SESSION['carrito'][$id_producto]);
            break;
    }
}

// Al terminar, siempre redirigir de vuelta al carrito
$conexion->close();
header("Location: ../carritow.php");
exit;
?>