<?php
// sesion.php

session_start();

/**
 * Inicia una sesión para un usuario.
 *
 * @param int $userId El ID del usuario.
 * @param string $userName El nombre de usuario.
 */
function iniciar_sesion($userId, $userName) {
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_name'] = $userName;
    $_SESSION['logged_in'] = true;
}

/**
 * Cierra la sesión del usuario.
 */
function cerrar_sesion() {
    session_unset();
    session_destroy();
}

/**
 * Verifica si el usuario está autenticado.
 *
 * @return bool Verdadero si el usuario está autenticado, falso de lo contrario.
 */
function esta_autenticado() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}
?>
