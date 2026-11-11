<?php
require_once 'conexion.php';
require_once 'funciones.php';
$errores = [];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $dni = trim($_POST['dni'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nombre === '' || $apellido === '' || $dni === '' || $email === '' || $password === '') {
        $errores[] = 'Completá todos los campos.';
    }
    if (!preg_match('/^[0-9]{7,8}$/', $dni)) {
        $errores[] = 'El DNI debe tener 7 u 8 números.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingresá un correo válido.';
    }
    if (strlen($password) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }

    if (empty($errores)) {
        $buscar = $conexion->prepare('SELECT id FROM usuarios WHERE dni = :dni OR email = :email');
        $buscar->execute(['dni' => $dni, 'email' => $email]);
        if ($buscar->fetch()) {
            $errores[] = 'Ese DNI o correo ya está registrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO usuarios (nombre, apellido, dni, email, password_hash, rol)
                    VALUES (:nombre, :apellido, :dni, :email, :password, \'usuario\')';
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dni' => $dni,
                'email' => $email,
                'password' => $hash
            ]);
            $mensaje = 'Cuenta creada correctamente. Ya podés iniciar sesión.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Registro - Pixelaria</title><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Sharp:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet"><link rel="stylesheet" href="estilos.css"></head>
<body>
<header class="encabezado">   <div class="logo"><img src="img/pixelaria.png" alt="Logo Pixelaria Games"></div><nav><a href="index.php">Inicio</a><a href="login.php">Ingresar</a></nav></header>
<main class="formulario-pagina">
    <form class="formulario" method="POST" action="registro.php">
        <h1>Crear cuenta</h1>
        <p class="texto-suave">Unite a la comunidad Pixelaria.</p>
        <?php if ($mensaje !== ''): ?><p class="mensaje"><?= escapar($mensaje) ?></p><?php endif; ?>
        <?php foreach ($errores as $error): ?><p class="error"><?= escapar($error) ?></p><?php endforeach; ?>
        <label>Nombre</label><input type="text" name="nombre" maxlength="80" required>
        <label>Apellido</label><input type="text" name="apellido" maxlength="80" required>
        <label>DNI</label><input type="text" name="dni" pattern="[0-9]{7,8}" maxlength="8" required>
        <label>Correo electrónico</label><input type="email" name="email" maxlength="254" required>
        <label>Contraseña</label><input type="password" name="password" required>
        <button class="boton" type="submit">Registrarme</button>
        <p>¿Ya tenés cuenta? <a href="login.php">Iniciá sesión</a></p>
    </form>
</main>
</body></html>
