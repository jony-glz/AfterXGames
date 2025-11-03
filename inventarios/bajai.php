<?php

include '../php/conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../inventariow.php");
    exit;
}
$id = $_GET['id'];

try {
    $conexion->begin_transaction();

    
    $stmt_detalles = $conexion->prepare("DELETE FROM detalles_pedido WHERE id_producto = ?");
    $stmt_detalles->bind_param("i", $id); // "i" significa que la variable es un Entero (Integer)
    $stmt_detalles->execute();
    $stmt_detalles->close();

    
    $stmt_productos = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt_productos->bind_param("i", $id);
    $stmt_productos->execute();
    $stmt_productos->close();

    
    $conexion->commit();

} catch (Exception $e) {
    
    $conexion->rollback();
    echo "Error al borrar el producto: " . $e->getMessage();
    
    exit;
}


header("Location: ../inventariow.php");
exit;
?>