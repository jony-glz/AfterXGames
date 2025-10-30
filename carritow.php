<?php
session_start();
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preload" href="css/carrito.css">
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Carrito de Compras</title>
    
</head>

<body>
    <header><h1>Carrito de Compras</h1></header>
    <a href="index.php" class="regreso">Inicio</a>
    

    <?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío.</p>
    <?php else: ?>
    <main>
        <table border="1">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        <?php
        $total_general = 0;
        foreach ($carrito as $item) {
            $total = $item['precio'] * $item['cantidad'];
            $total_general += $total;
            echo "<tr>
                    <td>{$item['nombre']}</td>
                    <td>\${$item['precio']}</td>
                    <td>{$item['cantidad']}</td>
                    <td>\${$total}</td>
                  </tr>";
        }
        ?>
    </table>
    <h3>Total: $
        <?= $total_general ?>
    </h3>

    </main>
    
    <a href="comprar.php">Finalizar compra</a>
    <?php endif; ?>

</body>

</html>