<?php
header('Content-Type: application/json'); // Indica que la respuesta será en formato JSON

include('db.php'); // Incluye el archivo de conexión a la base de datos

// Verifica si se ha pasado el parámetro 'id'
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara la consulta SQL para obtener los permisos y roles asociados
    $stmt = $conn->prepare("
        SELECT per.id_permisos, per.descripcion AS permiso_descripcion, per_en_roles.estado, rol.descripcion AS rol_descripcion
        FROM permisos per
        LEFT JOIN permisos_en_roles per_en_roles ON per.id_permisos = per_en_roles.id_permisos
        LEFT JOIN roles rol ON per_en_roles.id_roles = rol.id_roles
        WHERE per.id_permisos = ?");
    $stmt->bind_param("i", $id); // Vincula el parámetro
    $stmt->execute(); // Ejecuta la consulta
    $result = $stmt->get_result(); // Obtiene los resultados de la consulta

    if ($result->num_rows > 0) {
        $permissions = []; // Array para almacenar los permisos encontrados

        // Itera sobre los resultados y los almacena en el array
        while ($row = $result->fetch_assoc()) {
            $permissions[] = $row;
        }

        // Devuelve los permisos en formato JSON
        echo json_encode($permissions);
    } else {
        // Si no se encuentran permisos, devuelve un mensaje vacío
        echo json_encode([]);
    }

    $stmt->close(); // Cierra la consulta preparada
} else {
    // Si no se ha pasado el parámetro 'id', devuelve un mensaje vacío
    echo json_encode([]);
}

$conn->close(); // Cierra la conexión a la base de datos
?>
