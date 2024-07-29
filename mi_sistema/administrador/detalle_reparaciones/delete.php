<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Obtener el ID del detalle de reparación a eliminar
$id = $_GET['id'];

// Preparar la consulta SQL para eliminar el detalle de reparación
$query = "DELETE FROM detalle_reparaciones WHERE id_detalle_reparaciones = '$id'";

// Ejecutar la consulta y verificar si fue exitosa
if (mysqli_query($conn, $query)) {
    header("Location: index.php"); // Redirigir a la página principal de la lista
    exit();
} else {
    echo "Error: " . mysqli_error($conn); // Mostrar mensaje de error
}
?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
