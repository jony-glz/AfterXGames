<?php
session_start();
$status = $_GET['status'] ?? 'error';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de la Compra</title>
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
    <main class="contenedor sombra">
        <?php if ($status === 'success'): ?>
            <h1>¡Gracias por tu compra!</h1>
            <p>Tu pago ha sido procesado exitosamente.</p>
            <?php if (isset($_SESSION['last_order_id'])): ?>
                <p>Tu ID de pedido es: <?php echo htmlspecialchars($_SESSION['last_order_id']); ?></p>
                
                <a href="factura.php?id=<?php echo htmlspecialchars($_SESSION['last_order_id']); ?>" class="boton" target="_blank">
                    Descargar Factura (PDF)
                </a>
                
            <?php 
                unset($_SESSION['last_order_id']); 
            endif; ?>
        
        <?php else: ?>
            <h1>Hubo un problema</h1>
            <p>Lo sentimos, tu pago no pudo ser procesado.</p>
            <?php if (isset($_SESSION['error_compra'])): ?>
                <p>Error: <?php echo htmlspecialchars($_SESSION['error_compra']); ?></p>
            <?php 
                unset($_SESSION['error_compra']); 
            endif; ?>
            <p><a href="comprar.php" class="boton">Volver a intentarlo</a></p>
        
        <?php endif; ?>
        
        <br>
        <a href="index.php" class="linked-button">Volver al Inicio</a>
    </main>
</body>
</html>