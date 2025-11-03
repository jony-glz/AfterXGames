<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $comentario = $_POST['comentario'];

   
    $destinatario = $correo; 
    $asunto = "Nuevo comentario desde AfterXGames";

    
    $mensaje = "
    Has recibido un nuevo comentario desde la página AfterXGames:

    Nombre: $nombre
    Teléfono: $telefono
    Correo: "bryan171005@gmail.com";

    Comentario:
    $comentario
    ";

    // Cabeceras del correo
    $headers = "From: $correo\r\n";
    $headers .= "Reply-To: $correo\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

   
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "<script>
                alert('Gracias por tu comentario. ¡Tu mensaje ha sido enviado!');
                window.location.href = '../index.php';
              </script>";
    } else {
        echo "<script>
                alert('Hubo un error al enviar el mensaje. Inténtalo más tarde.');
                window.location.href = '../index.php';
              </script>";
    }
}
?>
