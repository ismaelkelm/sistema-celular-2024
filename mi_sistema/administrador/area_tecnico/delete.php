<?php
include '../../base_datos/db.php';

$id = $_GET['id'];

$query = "DELETE FROM area_tecnico WHERE id_area_tecnico = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: index.php');
    exit();
} else {
    die("Error en la eliminación: " . $conn->error);
}

$stmt->close();
$conn->close();
?>
