<?php
// historial_reparaciones.php
include_once '../privado/configuracion/bd.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../publico/inicio_sesion.php');
    exit();
}

$historial = obtenerHistorialReparaciones($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Reparaciones</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Historial de Reparaciones</h1>
    <table>
        <tr>
            <th>Número de Orden</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>
        <?php foreach ($historial as $reparacion): ?>
        <tr>
            <td><?php echo $reparacion['numero_orden']; ?></td>
            <td><?php echo $reparacion['descripcion']; ?></td>
            <td><?php echo $reparacion['estado']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
