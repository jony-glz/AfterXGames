<?php
include '..\php\conexion.php';

$id = $_GET['id'];
$result = $conexion->query("SELECT * FROM productos WHERE id = $id");
$producto = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $conexion->query("UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id=$id");
    header("Location: inventario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar juego | AfterXGames</title>
    <link rel="stylesheet" href="../css/inventario.css">
</head>
<body>
<main class="contenedor sombra">
    <h2>Editar juego</h2>
    <form method="POST">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>

        <label>Descripción</label>
        <textarea name="descripcion" required><?= $producto['descripcion'] ?></textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>

        <label>Stock</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required>

        <button type="submit" class="btn-guardar">Guardar cambios</button>
        <a href="inventario.php" class="btn-cancelar">Cancelar</a>
    </form>
</main>
</body>
</html>
