<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Obtener el ID del dispositivo a eliminar
$id = $_GET['id'];

// Preparar la consulta SQL para eliminar el dispositivo
$query = "DELETE FROM dispositivos WHERE id_dispositivos = '$id'";

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
