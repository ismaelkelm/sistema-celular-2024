<?php
//BDD de Alfredo
// $servername = "localhost:3308";
// $username = "root";
// $password = "";
// $database = "pruebas_marquez";

//BDD de Isma
$servername = "localhost";
$username = "root";
$password = "";
$database = "marquez";

//BDD General
// $servername = "arielon23.duckdns.org:3306";
// $username = "marquez";
// $password = "marquez2024";
// $database = "reparaciones";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    echo "La conexión falló: " . $conn->connect_error;
} else {
    echo "Conexión exitosa";
}
?>
