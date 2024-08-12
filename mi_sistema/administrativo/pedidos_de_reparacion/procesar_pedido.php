<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Recibir los datos del formulario
$id_cliente = $_POST['id_cliente'];
$id_dispositivo = $_POST['id_dispositivo'];
$fecha_de_pedido = $_POST['fecha_de_pedido'];
$estado = $_POST['estado'];
$numero_orden = $_POST['numero_orden'];

// Insertar el nuevo pedido en la base de datos
$query = "INSERT INTO pedidos_de_reparacion (id_clientes, id_dispositivos, fecha_de_pedido, estado, numero_orden)
          VALUES ('$id_cliente', '$id_dispositivo', '$fecha_de_pedido', '$estado', '$numero_orden')";

if (mysqli_query($conn, $query)) {
    // Redirigir al usuario a la lista de pedidos después de la inserción exitosa
    header('Location: index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
