<?php
require_once 'conexion.php'; require_once 'funciones.php'; pedirRol('admin');
$busqueda = trim($_GET['buscar'] ?? '');
$sql = 'SELECT * FROM usuarios WHERE nombre LIKE :busqueda OR apellido LIKE :busqueda OR dni LIKE :busqueda OR email LIKE :busqueda ORDER BY id DESC';
$stmt = $conexion->prepare($sql); $stmt->execute(['busqueda' => "%$busqueda%"]); $usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html><html lang="es"><head><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Asap+Sharp:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oswald:wght@200..700&display=swap" rel="stylesheet"><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Administrar usuarios</title><link rel="stylesheet" href="estilos.css"></head><body><header class="encabezado"><div class="logo"><img src="img/pixelaria.png" alt="Logo Pixelaria"></div><nav><a href="panel.php">Mi panel</a><a href="cerrar_sesion.php">Salir</a></nav></header><main class="seccion"><h1>Gestión de usuarios</h1><form method="GET" class="buscador"><input name="buscar" placeholder="Buscar por nombre, apellido, DNI o correo" value="<?= escapar($busqueda) ?>"><button class="boton">Buscar</button></form>
<div class="tabla-contenedor"><table><thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Correo</th><th>Rol</th><th>Estado</th><th>Acciones</th></tr></thead><tbody>
<?php foreach ($usuarios as $u): ?><tr><td><?= (int)$u['id'] ?></td><td><?= escapar($u['nombre']) ?></td><td><?= escapar($u['apellido']) ?></td><td><?= escapar($u['dni']) ?></td><td><?= escapar($u['email']) ?></td><td><?= escapar($u['rol']) ?></td><td><?= $u['archivado_en'] ? 'Archivado' : 'Activo' ?></td><td><a href="editar_usuario.php?id=<?= (int)$u['id'] ?>">Editar</a> | <a href="archivar_usuario.php?id=<?= (int)$u['id'] ?>"><?= $u['archivado_en'] ? 'Reactivar' : 'Archivar' ?></a></td></tr><?php endforeach; ?>
</tbody></table></div><p><a href="usuarios_archivados.php">Ver usuarios archivados</a></p></main></body></html>
