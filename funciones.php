<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function escapar($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

function usuarioConectado() {
    return isset($_SESSION['usuario_id']);
}

function pedirLogin() {
    if (!usuarioConectado()) {
        header('Location: login.php');
        exit;
    }
}

function pedirRol($rol) {
    pedirLogin();
    if (($_SESSION['usuario_rol'] ?? '') !== $rol) {
        http_response_code(403);
        exit('No tenés permiso para entrar a esta página.');
    }
}
