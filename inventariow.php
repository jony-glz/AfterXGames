<?php
include 'php\conexion.php'; // conexión a la BD

$resultado = $conexion->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario | AfterXGames</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/inventario.css">
</head>
<body>

<header class="titulo">
    <h1>Gestión de Inventario</h1>
</header>

<main class="contenedor sombra">
    <div class="juegon">
        <a href="inventarios\registroi.php" class="btn-agregar">+ Agregar nuevo juego</a>

    </div>
    
    <br>
    <table class="tabla-inventario">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['descripcion']) ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <a href="inventarios\editari.php?id=<?= $row['id'] ?>" class="btn-editar">Editar</a>
                        <a href="inventarios\bajai.php?id=<?= $row['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Eliminar este juego?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

</body>
</html>
