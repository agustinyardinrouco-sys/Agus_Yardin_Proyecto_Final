<?php
require_once 'conexion.php'; require_once 'funciones.php'; pedirRol('admin');
$stmt = $conexion->query('SELECT id, nombre, apellido, dni, email, rol FROM usuarios WHERE archivado_en IS NOT NULL ORDER BY id DESC'); $usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuarios archivados</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Sharp:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <main class="seccion">
            <h1>Usuarios archivados</h1>
            <div class="tabla-contenedor">
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= escapar($u['nombre']) ?></td>
                            <td><?= escapar($u['apellido']) ?></td>
                            <td><?= escapar($u['dni']) ?></td>
                            <td><?= escapar($u['email']) ?></td>
                            <td><?= escapar($u['rol']) ?></td>
                            <td><a href="archivar_usuario.php?id=<?= (int)$u['id'] ?>">Reactivar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <a href="admin_usuarios.php">Volver</a>
        </main>
    </body>
</html>
