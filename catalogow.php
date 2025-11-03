<?php
include 'php/conexion.php'; 


$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo | AfterXGames</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/catalogo.css">
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

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: top;
            border-radius: 0.5rem;

            /* Aquí pegué tus estilos del otro selector */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
        }
    </style>
</head>
<body>

<header class="titulo">
    <h1>Nuestro Catálogo</h1>
</header>

<main class="contenedor sombra">
    <a href="index.php" class="linked-button">Volver al inicio</a> <br><br>

    <section class="juegos">
        <div class="images">
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo '
                    <div class="card">
                        <img src="img/' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '">
                        <h3>' . htmlspecialchars($row['nombre']) . '</h3>
                        <p>' . htmlspecialchars($row['descripcion']) . '</p>
                        <p class="precio">$' . number_format($row['precio'], 2) . ' MXN</p>
                        <form action="php/agregar_carrito.php" method="POST">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <input type="hidden" name="nombre" value="' . htmlspecialchars($row['nombre']) . '">
                            <input type="hidden" name="precio" value="' . $row['precio'] . '">
                            <button type="submit" class="boton">Agregar al carrito</button>
                        </form>
                    </div>
                    ';
                }
            } else {
                echo "<p>No hay juegos disponibles en este momento.</p>";
            }
            ?>
        </div>
    </section>
</main>

</body>
</html>
