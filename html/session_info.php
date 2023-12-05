<?php
// session_info.php

// Inicia la sesión para obtener datos del usuario
session_start();

// Verifica si el usuario está autenticado
if (isset($_SESSION['usuario_nombre']) && isset($_SESSION['usuario_rol'])) {
    $nombreUsuario = $_SESSION['usuario_nombre'];
    $rolUsuario = $_SESSION['usuario_rol'];
}
?>
