<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

$id_pedidos_de_reparacion = mysqli_real_escape_string($conn, $_GET['id']);

$query = "DELETE FROM pedidos_de_reparacion WHERE id_pedidos_de_reparacion='$id_pedidos_de_reparacion'";

if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    die("Error al eliminar el pedido: " . mysqli_error($conn));
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
