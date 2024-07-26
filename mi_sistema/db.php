<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "marquez";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
?>
