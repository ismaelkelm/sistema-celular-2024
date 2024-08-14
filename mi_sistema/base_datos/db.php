<?php
$servername = "arielon23.duckdns.org";
$username = "marquez";
$password = "marquez2024";
$database = "marquez";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    echo "La conexión falló: " . $conn->connect_error;
} else {
    echo "Conexión exitosa";
}
?>
