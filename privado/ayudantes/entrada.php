<?php
// entrada.php

/**
 * Sanitiza la entrada del usuario para prevenir ataques de inyección.
 *
 * @param string $data La entrada del usuario.
 * @return string La entrada sanitizada.
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Valida que un correo electrónico tenga un formato válido.
 *
 * @param string $email El correo electrónico a validar.
 * @return bool Verdadero si el formato es válido, falso de lo contrario.
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
?>
