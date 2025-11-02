<?php
include '..\php\conexion.php';
$id = $_GET['id'];
$conexion->query("DELETE FROM productos WHERE id = $id");
header("Location: inventario.php");
exit;
?>
