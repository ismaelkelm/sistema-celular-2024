<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id_tecnicos'])) {
    die('ID de técnico no especificado.');
}

$id_tecnicos = $_GET['id_tecnicos'];

// Eliminar el técnico
$query = "DELETE FROM tecnicos WHERE id_tecnicos = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_tecnicos);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de técnicos
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
