<?php
require_once 'conexion.php';
require_once 'funciones.php';
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');   
    $password = $_POST['password'] ?? '';
    $sql = 'SELECT * FROM usuarios WHERE email = :email AND archivado_en IS NULL LIMIT 1';
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();
    if ($usuario && password_verify($password, $usuario['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_rol'] = $usuario['rol'];
        header('Location: panel.php');
        exit;
    } else {
        $errores[] = 'El correo o la contraseña son incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Ingresar - Pixelaria</title><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Sharp:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet"><link rel="stylesheet" href="estilos.css"></head>
<body><header class="encabezado"><div class="logo"><img src="img/pixelaria.png" alt="Logo Pixelaria Games"></div><nav><a href="index.php">Inicio</a><a href="registro.php">Registrarse</a></nav></header>
<main class="formulario-pagina"><form class="formulario" method="POST" action="login.php">
    <h1>Iniciar sesión</h1><p class="texto-suave">Ingresá a tu cuenta de Pixelaria.</p>
    <?php foreach ($errores as $error): ?><p class="error"><?= escapar($error) ?></p><?php endforeach; ?>
    <label>Correo electrónico</label><input type="email" name="email" required>
    <label>Contraseña</label><input type="password" name="password" required>
    <button class="boton" type="submit">Ingresar</button>
    <p>¿No tenés cuenta? <a href="registro.php">Registrate</a></p>
</form></main></body></html>
