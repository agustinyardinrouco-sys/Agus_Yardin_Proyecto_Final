<?php
require_once 'conexion.php';
require_once 'funciones.php';
pedirLogin();
$rol = $_SESSION['usuario_rol'];
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Mi panel - Pixelaria</title><link rel="stylesheet" href="estilos.css"></head>
<body><header class="encabezado"><div class="logo"><img src="img/pixelaria.png" alt="Logo Pixelaria"></div><nav><a href="index.php">Catálogo</a><a href="cerrar_sesion.php">Cerrar sesión</a></nav></header>
<main class="seccion panel">
    <h1>¡Hola, <?= escapar($_SESSION['usuario_nombre']) ?>!</h1>
    <?php if ($rol === 'usuario'): ?>
        <h2>Panel personal</h2>
        <p>Desde acá podés consultar tu cuenta y volver al catálogo de videojuegos.</p>
        <a class="boton" href="index.php">Ver catálogo</a>
    <?php elseif ($rol === 'admin'): ?>
        <h2>Panel de administrador</h2>
        <p>Desde acá podés buscar, editar, archivar y reactivar usuarios.</p>
        <a class="boton" href="admin_usuarios.php">Gestionar usuarios</a>
    <?php endif; ?>
</main></body></html>
