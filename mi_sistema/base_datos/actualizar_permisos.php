<?php
require_once '../../mi_sistema/base_datos/db.php';

if (!isset($_POST['roles_id_roles']) || !isset($_POST['Permisos_idPermisos']) || !isset($_POST['estado'])) {
    die('Datos incompletos.');
}

$roles_id_roles = $_POST['roles_id_roles'];
$Permisos_idPermisos = $_POST['Permisos_idPermisos'];
$estado = $_POST['estado'];

$query = "UPDATE permisos_en_roles SET estado = ? WHERE roles_id_roles = ? AND Permisos_idPermisos = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("iii", $estado, $roles_id_roles, $Permisos_idPermisos);
$stmt->execute();

if ($stmt->affected_rows === 0) {
    echo 'No se actualizó ningún registro.';
} else {
    echo 'Estado actualizado correctamente.';
}

$stmt->close();
$conn->close();
?>