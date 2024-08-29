<?php
header('Content-Type: application/json');

include('db.php'); // Incluye el archivo de conexión a la base de datos

if (isset($_POST['id_permiso']) && isset($_POST['rolId']) && isset($_POST['estado'])) {
    $idPermiso = $_POST['id_permiso'];
    $rolId = $_POST['rolId'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE permisos_en_roles SET estado = ? WHERE id_permisos = ? AND id_roles = ?");
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("iii", $estado, $idPermiso, $rolId);
    $stmt->execute();

    if ($stmt->error) {
        echo json_encode(['success' => false, 'message' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
        exit();
    }

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el rol o permiso para actualizar.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan parámetros.']);
}

$conn->close();
?>
