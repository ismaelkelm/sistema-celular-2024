<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id_usuarios'])) {
    die('ID de usuario no especificado.');
}

$id_usuarios = $_GET['id_usuarios'];

// Eliminar el usuario
$query = "DELETE FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuarios);

if ($stmt->execute()) {
    header("Location: index.php"); // Redirigir a la lista de usuarios
    exit();
} else {
    die("Error al eliminar: " . $stmt->error);
}
?>
