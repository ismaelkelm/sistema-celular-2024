<?php
include '../../base_datos/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numero_de_serie = $_POST['numero_de_serie'];
    $estado = $_POST['estado'];

    $query = "INSERT INTO dispositivos (marca, modelo, numero_de_serie, estado) 
              VALUES ('$marca', '$modelo', '$numero_de_serie', '$estado')";

    if (mysqli_query($conn, $query)) {
        // Redirigir al formulario de registro de pedido de reparación
        header("Location: registrar_pedido.php?id_cliente=" . $id_cliente . "&id_dispositivo=" . mysqli_insert_id($conn));
    } else {
        die("Error al registrar el dispositivo: " . mysqli_error($conn));
    }
}
?>
