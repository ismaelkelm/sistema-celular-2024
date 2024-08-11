<?php
include '../../base_datos/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $direccion = $_POST['direccion'];
    $dni = $_POST['dni'];

    $query = "INSERT INTO clientes (nombre, apellido, telefono, correo_electronico, direccion, dni) 
              VALUES ('$nombre', '$apellido', '$telefono', '$correo_electronico', '$direccion', '$dni')";

    if (mysqli_query($conn, $query)) {
        // Redirigir al formulario de registro de dispositivo
        header("Location: registrar_dispositivo.php?id_cliente=" . mysqli_insert_id($conn));
    } else {
        die("Error al registrar el cliente: " . mysqli_error($conn));
    }
}
?>
