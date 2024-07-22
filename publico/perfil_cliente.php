<?php
// perfil_cliente.php
include_once '../privado/configuracion/bd.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: inicio_sesion.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$perfil = obtenerPerfilUsuario($usuario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Cliente</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Perfil del Cliente</h1>
    <p>Nombre: <?php echo $perfil['nombre']; ?></p>
    <p>Email: <?php echo $perfil['email']; ?></p>
</body>
</html>
