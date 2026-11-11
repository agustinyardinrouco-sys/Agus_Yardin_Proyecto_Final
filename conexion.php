<?php
$host = 'localhost';
$dbname = 'pixelaria_games';
$usuario = 'root';
$password = '';

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $password
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('No se pudo conectar con la base de datos.');
}
