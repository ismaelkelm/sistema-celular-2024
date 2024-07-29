<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

// Obtener el ID del cliente a eliminar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si se ha recibido un ID válido
if ($id) {
    // Eliminar el cliente de la base de datos
    $query = "DELETE FROM clientes WHERE id_clientes = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        die("Error al eliminar el cliente: " . mysqli_error($conn));
    }
} else {
    die("ID de cliente no válido.");
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
