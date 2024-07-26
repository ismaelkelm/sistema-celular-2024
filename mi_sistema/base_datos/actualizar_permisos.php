<?php
// Incluir funciones desde el archivo en la misma carpeta
include 'functions.php';

// Obtener los permisos enviados desde el formulario
$nuevos_permisos = $_POST['permisos'] ?? [];

// Guardar los permisos actualizados en el archivo en la misma carpeta
file_put_contents('permisos.php', '<?php return ' . var_export($nuevos_permisos, true) . ';');

// Redirigir al usuario con un mensaje de éxito
header('Location: gestionar_permisos.php?status=success');
exit();
