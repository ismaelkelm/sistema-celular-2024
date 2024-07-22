<?php
// detalles_pedido.php
include_once '../privado/configuracion/bd.php';

if (isset($_GET['numero_orden'])) {
    $numeroOrden = $_GET['numero_orden'];
    $detalles = obtenerDetallesPedido($numeroOrden);
} else {
    $mensaje = "Número de orden no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Detalles del Pedido</h1>
    <?php if (isset($detalles)): ?>
    <p>Número de Orden: <?php echo $detalles['numero_orden']; ?></p>
    <p>Cliente: <?php echo $detalles['cliente']; ?></p>
    <p>Descripción: <?php echo $detalles['descripcion']; ?></p>
    <?php endif; ?>
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
</body>
</html>
