<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

// Obtener el ID del detalle de factura a eliminar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si se ha recibido un ID válido
if ($id) {
    // Eliminar el detalle de factura de la base de datos
    $query = "DELETE FROM detalle_facturas WHERE id_detalle_facturas = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        die("Error al eliminar el detalle de factura: " . mysqli_error($conn));
    }
} else {
    die("ID de detalle de factura no válido.");
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
