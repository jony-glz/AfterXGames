<?php
include '..\php\conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
      
    $imagen = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $destino = "../img/" . $imagen;

     // mover imagen a carpeta img
    if (move_uploaded_file($rutaTemporal, $destino)) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen)
                VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$imagen')";
        $conexion->query($sql);
        header("Location: ..\inventariow.php");
        exit;
    } else {
        echo "<script>alert('Error al subir la imagen.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar juego | AfterXGames</title>
    <link rel="stylesheet" href="..\css\inventario.css">
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
<main class="contenedor sombra ">
    <h2>Agregar nuevo juego</h2>
    <a href="..\index.php" class="linked-button">Inicio</a>

        <form method="POST" class="formulario" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Descripción</label>
        <textarea name="descripcion" required></textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" required>

        <label>Stock</label>
        <input type="number" name="stock" required>

         <label>Imagen:</label>
        <input type="file" name="imagen" accept="image/*" required><br>

        <button type="submit" class="linked-button">Guardar</button>
        <a href="..\inventariow.php" class="linked-button alinear ">Cancelar</a>
    </form>


    
</main>
</body>
</html>
