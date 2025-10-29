<?php
$host = "localhost";
$user = "root"; 
$pass = "";     
$db = "afterx";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}


?>
