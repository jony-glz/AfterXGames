<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - AfterXGames</title>
    <link rel="stylesheet" href="css/stylesspr.css">
    

</head>
<body>
  
    <main class="contenedor sombra">
        <h2>Iniciar Sesión</h2>

        <form action="php\login.php" method="POST" class="ff">
            <fieldset>
                <legend>Accede a tu cuenta</legend>
                
                <div class="campo">
                    <label>Usuario</label>
                    <input class="input-text" type="text" name="usuario" required>
                </div>
                
                <div class="campo">
                    <label>Contraseña</label>
                    <input class="input-text" type="password" name="contrasena" required>
                </div>
                
                <div class="alinear-derecha flex">
                    <input class="boton w-100" type="submit" name="login" value="Ingresar"  >


                </div>
            </fieldset>
        </form>
        <script src="js/validar_login.js"></script>

        <p style="text-align:center;">¿No tienes cuenta? <a href="registrow.php">Regístrate</a></p>
    </main>
</body>
</html>
