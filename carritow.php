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
    <title>Carrito de Compras</title>
    
</head>

<body>
    <header><h1>Carrito de Compras</h1></header>
    <a href="index.php" class="linked-button">Inicio</a>
    
    <?php
    // Errores de stock o mensajes del carrito
    if (isset($_SESSION['mensaje_carrito'])) {
        echo "<p style='color:red; text-align:center; font-weight:bold;'>" . htmlspecialchars($_SESSION['mensaje_carrito']) . "</p>";
        // Borramos el mensaje para que no se muestre de nuevo
        unset($_SESSION['mensaje_carrito']);
    }
    ?>

    <?php if (empty($carrito)): ?>
    <main class="contenedor sombra">
        <p style="text-align: center;">Tu carrito está vacío.</p>
    </main>
    <?php else: ?>
    <main>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            <?php
            $total_general = 0;
            
            foreach ($carrito as $id_producto => $item) {
                $total = $item['precio'] * $item['cantidad'];
                $total_general += $total;
                
                echo "<tr>";
                echo "<td>{$item['nombre']}</td>";
                echo "<td>\${$item['precio']}</td>";
                
                // Actulizar cantidad de producto
                echo '<td>
                        <form action="php/actualizar_carrito.php" method="POST" class="form-cantidad">
                            <input type="hidden" name="id" value="' . $id_producto . '">
                            <input type="hidden" name="action" value="update">
                            <input type="number" name="cantidad" value="' . $item['cantidad'] . '" min="1" style="width: 50px;">
                            <button type="submit">Actualizar</button>
                        </form>
                      </td>';
                
                echo "<td>\${$total}</td>";

                // Eliminar producto del carrito
                echo '<td>
                        <form action="php/actualizar_carrito.php" method="POST">
                            <input type="hidden" name="id" value="' . $id_producto . '">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" style="background-color: #ff4d4d;">Eliminar</button>
                        </form>
                      </td>';
                
                echo "</tr>";
            }
            ?>
        </table>
        
        <h3>Total: $<?= $total_general ?></h3>
    </main>
    
    <a href="comprar.php" class="linked-button">Finalizar compra</a>
    <?php endif; ?>

</body>

</html>