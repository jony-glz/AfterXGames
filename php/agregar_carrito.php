<?php
session_start();
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto]['cantidad']++;
    } else {
        
        $_SESSION['carrito'][$id_producto] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => 1
        ];
    }

    header("Location: ..\carritow.php"); 
    exit;
}
?>
