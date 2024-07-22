<?php
// dashboard_admin.php
include_once '../privado/configuracion/bd.php';
session_start();

if (!isset($_SESSION['usuario']) || !esAdministrador($_SESSION['usuario'])) {
    header('Location: ../publico/inicio_sesion.php');
    exit();
}

$reparacionesPendientes = obtenerReparacionesPendientes();
$pedidosPendientes = obtenerPedidosPendientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Dashboard Administrador</h1>
    <h2>Reparaciones Pendientes</h2>
    <ul>
        <?php foreach ($reparacionesPendientes as $reparacion): ?>
        <li><?php echo $reparacion['descripcion']; ?></li>
        <?php endforeach; ?>
    </ul>
    <h2>Pedidos Pendientes</h2>
    <ul>
        <?php foreach ($pedidosPendientes as $pedido): ?>
        <li><?php echo $pedido['descripcion']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
