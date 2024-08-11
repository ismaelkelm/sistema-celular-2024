<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

// Obtener el ID del accesorio a eliminar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    $query = "DELETE FROM accesorios WHERE id_accesorios = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID no válido.";
}
?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
