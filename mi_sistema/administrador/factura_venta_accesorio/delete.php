<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de factura de venta accesorio no especificado.');
}

$id = $_GET['id'];

// Eliminar factura de venta accesorio
$query = "DELETE FROM factura_venta_accesorio WHERE id_factura_venta_accesorio = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de facturas de venta accesorio
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
