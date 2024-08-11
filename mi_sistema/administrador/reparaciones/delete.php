<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = "DELETE FROM reparaciones WHERE id_reparaciones='$id'";

if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    die("Error al eliminar la reparación: " . mysqli_error($conn));
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
