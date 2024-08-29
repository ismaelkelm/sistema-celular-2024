<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de factura de venta reparación no especificado.');
}

$id = $_GET['id'];

// Eliminar factura de venta reparación
$query = "DELETE FROM facturas_venta_reparacion WHERE id_facturas_venta_reparacion = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de facturas de venta reparación
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
