<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Verificar si se ha enviado un ID de empleado
if (isset($_GET['id'])) {
    $id_empleados = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Preparar la consulta SQL para eliminar el empleado
    $query = "DELETE FROM empleados WHERE id_empleados = $id_empleados";
    
    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($conn, $query)) {
        header("Location: index.php"); // Redirigir a la página principal de la lista
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Mostrar mensaje de error
    }
} else {
    die("ID de empleado no especificado.");
}
?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
