<?php
require_once 'conexion.php';
require_once 'funciones.php';

$sql = 'SELECT * FROM videojuegos ORDER BY id';
$consulta = $conexion->query($sql);
$videojuegos = $consulta->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelaria Games</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Sharp:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header class="encabezado">
    <div class="logo"><img src="img/pixelaria.png" alt="Logo Pixelaria Games"></div>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="#catalogo">Catálogo</a>
        <?php if (usuarioConectado()): ?>
            <a href="panel.php">Mi panel</a>
            <a href="cerrar_sesion.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php">Ingresar</a>
            <a href="registro.php">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section class="bienvenida">
        <div>
            <p class="etiqueta">TU PRÓXIMA AVENTURA EMPIEZA ACÁ</p>
            <h1>Descubrí tu próximo videojuego</h1>
            <p>Explorá nuestro catálogo y conocé algunos de los videojuegos más populares.</p>
            <a class="boton" href="#catalogo">Ver catálogo</a>
        </div>
        <div class="imagen-portada"><img src="img/banner.png" alt="Banner"></div>
    </section>

    <section id="catalogo" class="seccion">
        <h2>Catálogo de videojuegos</h2>
        <p class="texto-suave">Conocé los juegos disponibles en Pixelaria Games.</p>
        <div class="juegos">
        <?php foreach ($videojuegos as $juego): ?>
            <article class="tarjeta">
                <div class="juego-imagen">
                    <?php if (!empty($juego['imagen'])): ?>
                        <img src="<?= escapar($juego['imagen']) ?>" alt="<?= escapar($juego['nombre']) ?>">
                    <?php else: ?>
                        <!-- ESPACIO PARA AGREGAR LA IMAGEN DEL VIDEOJUEGO -->
                    <?php endif; ?>
                </div>
                <div class="tarjeta-contenido">
                    <h3><?= escapar($juego['nombre']) ?></h3>
                    <p><?= escapar($juego['descripcion']) ?></p>
                    <strong>$<?= number_format((float)$juego['precio'], 2, ',', '.') ?></strong>
                </div>
            </article>
        <?php endforeach; ?>
        </div>
        <p class="texto-suave">Este catálogo es demostrativo. La página no realiza compras.</p>
    </section>
</main>
<footer><p>Pixelaria Games - Catálogo de videojuegos</p></footer>
</body>
</html>
