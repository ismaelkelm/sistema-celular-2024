<?php
// generar_factura.php
include_once '../privado/configuracion/bd.php';

if (isset($_GET['numero_orden'])) {
    $numeroOrden = $_GET['numero_orden'];
    $factura = generarFactura($numeroOrden);
} else {
    $mensaje = "Número de orden no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Factura</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Generar Factura</h1>
    <?php if (isset($factura)): ?>
    <p>Factura: <?php echo $factura['detalle']; ?></p>
    <?php endif; ?>
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
</body>
</html>
