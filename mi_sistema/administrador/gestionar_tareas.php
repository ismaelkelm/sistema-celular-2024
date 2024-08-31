<?php
// gestionar_permisos.php

require_once '../../mi_sistema/base_datos/db.php';

// Verifica si se ha recibido el parámetro de búsqueda 'nombre'
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';

if ($nombre !== '') {
    // Prepara la consulta SQL para buscar roles que coincidan con el nombre
    $query = "SELECT id_roles, nombre FROM roles WHERE nombre LIKE ?";
    $stmt = $conn->prepare($query);
    
    // Usa un comodín para buscar coincidencias parciales
    $searchTerm = "%" . $nombre . "%";
    $stmt->bind_param('s', $searchTerm);
    
    // Ejecuta la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Recoge los resultados en un array
    $roles = [];
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }

    // Devuelve los resultados en formato JSON
    echo json_encode($roles);
} else {
    // Si no se proporciona ningún nombre, devuelve un array vacío
    echo json_encode([]);
}

// Cierra la conexión
$stmt->close();
$conn->close();
