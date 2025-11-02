<?php
session_start();

// Verificar que el carrito no esté vacío
if (empty($_SESSION['carrito'])) {
    header("Location: carritow.php");
    exit;
}

// Calcular total general
$total_general = 0;
foreach ($_SESSION['carrito'] as $id => $item) {
    $total_general += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Pago</title>
    <link rel="stylesheet" href="css/stylesspr.css">
    <link rel="stylesheet" href="css/carrito.css"> 
    <style>
        .linked-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header><h1>Confirmar Pago</h1></header>
    <a href="carritow.php" class="linked-button">Volver al Carrito</a><br>

    <main class="contenedor sombra">
        <h2>Resumen del Pedido</h2>
        <h3>Total a pagar: $<?php echo number_format($total_general, 2); ?> MXN</h3>
        <p>Estás a punto de ser redirigido a PayPal para completar tu pago de forma segura.</p>

        <a href="php/pagar.php" class="boton w-100">
            Pagar con PayPal
        </a>
    </main>
</body>
</html>