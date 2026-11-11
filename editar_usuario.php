<?php
require_once 'conexion.php'; require_once 'funciones.php'; pedirRol('admin');
$id = (int)($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT * FROM usuarios WHERE id = :id'); $stmt->execute(['id' => $id]); $usuario = $stmt->fetch();
if (!$usuario) exit('Usuario no encontrado.');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = 'UPDATE usuarios SET nombre = :nombre, apellido = :apellido, email = :email, rol = :rol WHERE id = :id';
    $update = $conexion->prepare($sql);
    $rol = in_array($_POST['rol'] ?? '', ['usuario','admin'], true) ? $_POST['rol'] : 'usuario';
    $update->execute(['nombre' => trim($_POST['nombre'] ?? ''), 'apellido' => trim($_POST['apellido'] ?? ''), 'email' => trim($_POST['email'] ?? ''), 'rol' => $rol, 'id' => $id]);
    header('Location: admin_usuarios.php'); exit;
}
?>
<!DOCTYPE html><html lang="es">
    <head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar usuario</title><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Sharp:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet"><link rel="stylesheet" href="estilos.css"></head>
    <body>
        <main class="formulario-pagina">
            <form class="formulario" method="POST">
                <h1>Editar usuario</h1>
                <label>Nombre</label>
                <input name="nombre" value="<?= escapar($usuario['nombre']) ?>" required>
                <label>Apellido</label>
                <input name="apellido" value="<?= escapar($usuario['apellido']) ?>" required>
                <label>Correo</label>
                <input type="email" name="email" value="<?= escapar($usuario['email']) ?>" required>
                <label>Rol</label>
                <select name="rol">
                    <option value="usuario" <?= $usuario['rol']==='usuario'?'selected':'' ?>>Usuario</option>
                    <option value="admin" <?= $usuario['rol']==='admin'?'selected':'' ?>>Administrador</option>
                </select>
                <button class="boton">Guardar</button>
            </form>
        </main>
    </body>
</html>
