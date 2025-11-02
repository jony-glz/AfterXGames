<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'conexion.php'; 

$mensaje = "";

if(isset($_POST['registrar'])){
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);


    $verificar = "SELECT * FROM usuarios WHERE usuario='$usuario' OR correo='$correo'";
    $resultado = mysqli_query($conexion, $verificar);

    if(mysqli_num_rows($resultado) > 0){
        $mensaje = "El usuario o correo ya existe";
    } else {
        
        $sql = "INSERT INTO usuarios (usuario, contrasena, nombre, correo, telefono, rol) 
                VALUES ('$usuario', '$password', '$nombre', '$correo', '$telefono', 'cliente')";
        if(mysqli_query($conexion, $sql)){
           echo $mensaje = "Registro exitoso, ya puedes <a href='../loginw.php'>iniciar sesión</a>";
        } else {
           echo $mensaje = "Error al registrar usuario";
        }
    }
}
?>
