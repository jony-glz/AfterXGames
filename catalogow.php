<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo | AfterXGames</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/catalogo.css">
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

    <header class="titulo">
        <h1>Nuestro Catálogo</h1>
    </header>

    <main class="contenedor sombra">
        <a href="index.php" class="linked-button">Volver al inicio</a> <br><br>
        <section class="juegos">
            <div class="images">
              
                <div class="card">
                    <img src="img/Hk.jpg" alt="Hollow Knight">
                    <h3>Hollow Knight</h3>
                    <p>Aventura oscura en un mundo subterráneo lleno de misterios.</p>
                    <p class="precio">$899 MXN</p>
                    <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="4">
                        <input type="hidden" name="nombre" value="Hollow Knight">
                        <input type="hidden" name="precio" value="899">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

              
                <div class="card">
                    <img src="img/SH4jpg.jpg" alt="Silent Hill 3">
                    <h3>Silent Hill 3</h3>
                    <p>Horror psicológico en su máxima expresión.</p>
                    <p class="precio">$399 MXN</p>
                    <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="5">
                        <input type="hidden" name="nombre" value="Silent Hill 3">
                        <input type="hidden" name="precio" value="399">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

               
                <div class="card">
                    <img src="img/finalf.jpg" alt="Final Fantasy">
                    <h3>Final Fantasy XVI</h3>
                    <p>Un nuevo viaje épico en un universo lleno de magia.</p>
                    <p class="precio">$899 MXN</p>
                   <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="6">
                        <input type="hidden" name="nombre" value="Final Fantasy XVI">
                        <input type="hidden" name="precio" value="899">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

              
                <div class="card">
                    <img src="img/mk.jpg" alt="Mortal Kombat">
                    <h3>Mortal Kombat 1</h3>
                    <p>Los clásicos regresan con combates más intensos.</p>
                    <p class="precio">$799 MXN</p>
                    <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="7">
                        <input type="hidden" name="nombre" value="Mortal Kombat 1">
                        <input type="hidden" name="precio" value="799">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

               
                <div class="card">
                    <img src="img/codjpg.jpg" alt="Call of Duty">
                    <h3>Call of Duty </h3>
                    <p>Acción y estrategia en una experiencia bélica moderna.</p>
                    <p class="precio">$999 MXN</p>
                    <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="8">
                        <input type="hidden" name="nombre" value="Call of Duty">
                        <input type="hidden" name="precio" value="999">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

                
                <div class="card">
                    <img src="img/left.jpg" alt="Left 4 Dead 2">
                    <h3>Left 4 Dead 2</h3>
                    <p>Sobrevive al apocalipsis zombie junto a tus amigos.</p>
                    <p class="precio">$349 MXN</p>
                    <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="9">
                        <input type="hidden" name="nombre" value="Left 4 Dead 2">
                        <input type="hidden" name="precio" value="399">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

                <div class="card">
                    <img src="img/REPO.jpg" alt="R.E.P.O">
                    <h3>R.E.P.O</h3>
                    <p>Misterio mediante monitos.</p>
                    <p class="precio">$249 MXN</p>
                       <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="10">
                        <input type="hidden" name="nombre" value="REPO">
                        <input type="hidden" name="precio" value="299">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>


                 <div class="card">
                    <img src="img/R6.jpg" alt="R6">
                    <h3>Rainbow six siege</h3>
                    <p>shooter tactico.</p>
                    <p class="precio">$549 MXN</p>
                      <form action="php\agregar_carrito.php" method="POST">
                        <input type="hidden" name="id" value="11">
                        <input type="hidden" name="nombre" value="Rainbow six siege">
                        <input type="hidden" name="precio" value="599">
                        <button type="submit" class="boton">Agregar al carrito</button>
                    </form>
                </div>

            </div>
        </section>
    </main>

</body>
</html>
