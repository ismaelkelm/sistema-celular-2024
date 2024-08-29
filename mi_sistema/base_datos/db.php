<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$database = "pruebas_marquez";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    echo "La conexión falló: " . $conn->connect_error;
} else {
    echo "Conexión exitosa";
}
?>
