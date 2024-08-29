<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de detalle de compra no especificado.');
}

$id = $_GET['id'];

// Eliminar el detalle de compra
$query = "DELETE FROM detalle_compra WHERE id_detalle_compra = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de detalles de compra
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
