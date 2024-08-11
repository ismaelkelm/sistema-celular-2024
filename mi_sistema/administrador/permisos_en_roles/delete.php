<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

$roles_id_roles = mysqli_real_escape_string($conn, $_GET['roles_id']);
$Permisos_idPermisos = mysqli_real_escape_string($conn, $_GET['permiso_id']);

$query = "DELETE FROM permisos_en_roles WHERE roles_id_roles='$roles_id_roles' AND Permisos_idPermisos='$Permisos_idPermisos'";

if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    die("Error al eliminar el permiso en rol: " . mysqli_error($conn));
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
