<?php
include '../../base_datos/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $id_dispositivo = $_POST['id_dispositivo'];
    $fecha_de_pedido = $_POST['fecha_de_pedido'];
    $estado = $_POST['estado'];
    $numero_orden = $_POST['numero_orden'];

    $query = "INSERT INTO pedidos_de_reparacion (id_clientes, id_dispositivos, fecha_de_pedido, estado, numero_orden) 
              VALUES ('$id_cliente', '$id_dispositivo', '$fecha_de_pedido', '$estado', '$numero_orden')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php"); // Redirigir a la lista de pedidos de reparación
    } else {
        die("Error al registrar el pedido de reparación: " . mysqli_error($conn));
    }
}
?>
