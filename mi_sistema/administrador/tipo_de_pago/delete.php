<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id_tipo_de_pago'])) {
    die('ID de tipo de pago no especificado.');
}

$id_tipo_de_pago = $_GET['id_tipo_de_pago'];

// Eliminar el tipo de pago
$query = "DELETE FROM tipo_de_pago WHERE id_tipo_de_pago = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_tipo_de_pago);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de tipos de pago
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
