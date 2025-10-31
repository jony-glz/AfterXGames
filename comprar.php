<?php
session_start();
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total_general = 0;
foreach ($carrito as $item) {
    $total_general += $item['precio'] * $item['cantidad'];
}
?>