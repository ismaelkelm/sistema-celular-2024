<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de detalle de venta de accesorios no especificado.');
}

$id = $_GET['id'];

// Eliminar detalle de venta de accesorios
$query = "DELETE FROM detalle_ventas_accesorios WHERE id_detalle_ventas_accesorios = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de detalles de ventas de accesorios
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
