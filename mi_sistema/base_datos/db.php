<?php
$servername = "localhost";
$username = "root";
$password = "";
// $database = "marquez";
$database = "pruebas_marquez2";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    echo "La conexión falló: " . $conn->connect_error;
} else {
    echo "";
}
?>
