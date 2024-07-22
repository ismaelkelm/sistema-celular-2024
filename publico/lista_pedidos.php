<?php
// lista_pedidos.php
include_once '../privado/configuracion/bd.php';

$pedidos = obtenerListaPedidos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Lista de Pedidos</h1>
    <table>
        <tr>
            <th>Número de Orden</th>
            <th>Cliente</th>
            <th>Estado</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
        <tr>
            <td><?php echo $pedido['numero_orden']; ?></td>
            <td><?php echo $pedido['cliente']; ?></td>
            <td><?php echo $pedido['estado']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
