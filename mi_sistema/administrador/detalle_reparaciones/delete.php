<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de detalle de reparación no especificado.');
}

$id = $_GET['id'];

// Eliminar detalle de reparación
$query = "DELETE FROM detalle_reparaciones WHERE id_detalle_reparaciones = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de detalles de reparación
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
