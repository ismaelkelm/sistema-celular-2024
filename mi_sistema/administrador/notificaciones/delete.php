<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

$id_notificaciones = mysqli_real_escape_string($conn, $_GET['id']);

$query = "DELETE FROM notificaciones WHERE id_notificaciones='$id_notificaciones'";

if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    die("Error al eliminar la notificación: " . mysqli_error($conn));
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
