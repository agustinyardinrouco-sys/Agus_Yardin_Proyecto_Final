<?php
require_once 'conexion.php'; require_once 'funciones.php'; pedirRol('admin');
$id = (int)($_GET['id'] ?? 0);
$stmt = $conexion->prepare('SELECT archivado_en FROM usuarios WHERE id = :id'); $stmt->execute(['id' => $id]); $usuario = $stmt->fetch();
if ($usuario) {
    if ($usuario['archivado_en'] === null) {
        $update = $conexion->prepare('UPDATE usuarios SET archivado_en = NOW() WHERE id = :id AND rol <> \'admin\'');
    } else {
        $update = $conexion->prepare('UPDATE usuarios SET archivado_en = NULL WHERE id = :id');
    }
    $update->execute(['id' => $id]);
}
header('Location: admin_usuarios.php'); exit;
