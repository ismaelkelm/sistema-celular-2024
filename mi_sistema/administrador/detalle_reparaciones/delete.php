<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if (isset($_GET['id'])) {
    $id_detalle_reparaciones = $_GET['id'];
    $query = "DELETE FROM detalle_reparaciones WHERE id_detalle_reparaciones=$id_detalle_reparaciones";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "ID no proporcionado.";
}
?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
