<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id_roles'])) {
    die('ID de rol no especificado.');
}

$id_roles = $_GET['id_roles'];

// Eliminar el rol
$query = "DELETE FROM roles WHERE id_roles = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_roles);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de roles
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
