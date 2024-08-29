<?php
header('Content-Type: application/json');

include('db.php'); // Incluye el archivo de conexión a la base de datos

if (isset($_GET['descripcion'])) {
    $descripcion = $_GET['descripcion'] . '%'; // Añade un comodín para búsqueda con autocompletado

    // Prepara la consulta SQL
    $stmt = $conn->prepare("SELECT id_permisos, descripcion FROM permisos WHERE descripcion LIKE ?");
    if ($stmt === false) {
        $error = 'Error en la preparación de la consulta: ' . $conn->error;
        echo json_encode(['success' => false, 'message' => $error]);
        exit();
    }

    // Vincula los parámetros y ejecuta la consulta
    $stmt->bind_param("s", $descripcion);
    $stmt->execute();
    if ($stmt->error) {
        $error = 'Error en la ejecución de la consulta: ' . $stmt->error;
        echo json_encode(['success' => false, 'message' => $error]);
        exit();
    }

    // Obtiene los resultados
    $result = $stmt->get_result();
    if ($result === false) {
        $error = 'Error al obtener los resultados: ' . $stmt->error;
        echo json_encode(['success' => false, 'message' => $error]);
        exit();
    }

    // Almacena los resultados en un array
    $permisos = [];
    while ($row = $result->fetch_assoc()) {
        $permisos[] = $row;
    }

    // Verifica si se encontraron permisos
    if (empty($permisos)) {
        echo json_encode(['success' => false, 'message' => 'No se encontraron permisos.']);
    } else {
        echo json_encode($permisos);
    }

    // Cierra la consulta y la conexión
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Parámetro de descripción faltante.']);
}

$conn->close();
?>
