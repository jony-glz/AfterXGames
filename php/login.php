<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'conexion.php'; 

$mensaje = "";

if(isset($_POST['login'])){
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $password = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    $query = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $result = mysqli_query($conexion, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        if($password == $row['contrasena']){
            $_SESSION['id_usuario'] = $row['id'];
            if($row['rol'] == 'admin'){
                $_SESSION['admin'] = $row['usuario'];
            } else {
                $_SESSION['cliente'] = $row['usuario'];
            }
        
            header("Location: ../index.php");
            exit;
        } else {
            $mensaje = "Contraseña incorrecta";
            echo "<script>alert('$mensaje');</script>";
        }
    } else {
        $mensaje = "Usuario no encontrado";
        echo "<script>alert('$mensaje');</script>";
    }
}

?>
