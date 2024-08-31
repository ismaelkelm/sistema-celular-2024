<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de pago no especificado.');
}

$id = $_GET['id'];

// Eliminar el pago
$query = "DELETE FROM pagos WHERE id_pagos = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de pagos
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
