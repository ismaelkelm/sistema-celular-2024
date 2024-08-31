<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de historial no especificado.');
}

$id = $_GET['id'];

// Eliminar historial de cambios de contraseña
$query = "DELETE FROM historial_cambios_contrasena WHERE id_historial = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de historial de cambios de contraseña
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
