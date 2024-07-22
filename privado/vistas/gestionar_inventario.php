<?php
// gestionar_inventario.php
include_once '../privado/configuracion/bd.php';
session_start();

if (!isset($_SESSION['usuario']) || !esAdministrador($_SESSION['usuario'])) {
    header('Location: ../publico/inicio_sesion.php');
    exit();
}

$inventario = obtenerInventario();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Inventario</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Gestionar Inventario</h1>
    <table>
        <tr>
            <th>Accesorio</th>
            <th>Stock</th>
            <th>Precio</th>
        </tr>
        <?php foreach ($inventario as $item): ?>
        <tr>
            <td><?php echo $item['nombre']; ?></td>
            <td><?php echo $item['stock']; ?></td>
            <td><?php echo $item['precio']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
