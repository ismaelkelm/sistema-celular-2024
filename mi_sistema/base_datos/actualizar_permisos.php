<?php
require_once '../../mi_sistema/base_datos/db.php';

// Verificar que se reciban los datos esperados
if (!isset($_POST['roles_id_roles']) || !isset($_POST['Permisos_id_permisos']) || !isset($_POST['estado'])) {
    die('Datos incompletos.');
}

// Obtener los datos del POST
$roles_id_roles = intval($_POST['roles_id_roles']);
$Permisos_id_permisos = intval($_POST['Permisos_id_permisos']);
$estado = intval($_POST['estado']);

// Preparar la consulta para actualizar el estado del permiso
$query = "UPDATE permisos_en_roles SET estado = ? WHERE id_roles = ? AND id_permisos = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

// Enlazar los parámetros y ejecutar la consulta
$stmt->bind_param("iii", $estado, $roles_id_roles, $Permisos_id_permisos);
$stmt->execute();

// Verificar si se actualizó algún registro
if ($stmt->affected_rows === 0) {
    echo 'No se actualizó ningún registro.';
} else {
    echo 'Estado actualizado correctamente.';
}

$stmt->close();
$conn->close();
?>
