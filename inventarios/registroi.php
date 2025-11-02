<?php
include '..\php\conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock)
            VALUES ('$nombre', '$descripcion', '$precio', '$stock')";
    $conexion->query($sql);
    header("Location: inventario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar juego | AfterXGames</title>
    <link rel="stylesheet" href="..\css\inventario.css">
</head>
<body>
<main class="contenedor sombra ">
    <h2>Agregar nuevo juego</h2>

        <form method="POST" class="formulario" >
        <label>Nombre</label>
        <input type="text" name=4"nombre" required>

        <label>Descripción</label>
        <textarea name="descripcion" required></textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" required>

        <label>Stock</label>
        <input type="number" name="stock" required>

        <button type="submit" class="btn-guardar">Guardar</button>
        <a href="inventario.php" class="btn-cancelar">Cancelar</a>
    </form>


    
</main>
</body>
</html>
