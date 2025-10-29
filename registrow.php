<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro - AfterXGames</title>
    <link rel="stylesheet" href="css/stylesspr.css">
</head>
<body>
    <main class="contenedor sombra">
        <h2>Registro de Usuarios</h2>

        <?php 
        $mensaje="";
        
        if($mensaje != ""){ ?>
            <p style="color:red; text-align:center;"><?php echo $mensaje; ?></p>
        <?php } ?>

        <form action="php\registro.php" method="POST" class="ff">
            <fieldset>
                <legend>Crea tu cuenta</legend>

                <div class="campo">
                    <label>Usuario</label>
                    <input class="input-text" type="text" name="usuario" required>
                </div>

                <div class="campo">
                    <label>Contraseña</label>
                    <input class="input-text" type="password" name="password" required>
                </div>

                <div class="campo">
                    <label>Nombre completo</label>
                    <input class="input-text" type="text" name="nombre" required>
                </div>

                <div class="campo">
                    <label>Correo electrónico</label>
                    <input class="input-text" type="email" name="correo" required>
                </div>

                <div class="campo">
                    <label>Teléfono</label>
                    <input class="input-text" type="text" name="telefono">
                </div>

                <div class="alinear-derecha flex">
                    <input class="boton w-100" type="submit" name="registrar" value="Registrarse" >
                </div>
            </fieldset>
        </form>

        <p style="text-align:center;">¿Ya tienes cuenta? <a href="loginw.php">Inicia sesión</a></p>
    </main>
</body>
</html>
