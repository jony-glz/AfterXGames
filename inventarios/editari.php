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

    
    if (!empty($_FILES['imagen']['name'])) {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = "../img/" . $nombreImagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
    } else {
        $nombreImagen = $producto['imagen']; 
    }

    $conexion->query("UPDATE productos 
                      SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', imagen='$nombreImagen' 
                      WHERE id=$id");

    header("Location: ..\inventariow.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar juego | AfterXGames</title>
    <link rel="stylesheet" href="../css/inventario.css">
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
    <h2>Editar juego</h2>

    <form method="POST" enctype="multipart/form-data" class="formulario" id="editarJuego">

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>

        <label>Descripción</label>
        <textarea name="descripcion" required><?= $producto['descripcion'] ?></textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>

        <label>Stock</label>
        <input type="number" name="stock" value="<?= $producto['stock'] ?>" required>

        <label>Imagen (opcional)</label>
        <input type="file" name="imagen" accept="image/*">

        <?php if (!empty($producto['imagen'])): ?>
            <p>Imagen actual:</p>
            <img src="../img/<?= $producto['imagen'] ?>" alt="Imagen del producto" width="120">
        <?php endif; ?>

        <button type="submit" class="linked-button">Guardar cambios</button>
        <a href="..\inventariow.php" class="linked-button">Cancelar</a>
    </form>
    <script src="../js/editar_juego.js"></script>
</main>
</body>
</html>
