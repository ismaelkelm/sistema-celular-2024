<?php
include '../../base_datos/db.php';

$id = $_GET['id'];

$query = "DELETE FROM historial_cambios_contrasena WHERE id_cambio = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    header('Location: index.php');
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
