<?php
// verificar_pagos.php
include_once '../privado/configuracion/bd.php';

if (isset($_GET['numero_orden'])) {
    $numeroOrden = $_GET['numero_orden'];
    $pago = verificarPago($numeroOrden);
} else {
    $mensaje = "Número de orden no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificar Pagos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Verificar Pagos</h1>
    <?php if (isset($pago)) echo "<p>Pago: $pago</p>"; ?>
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
</body>
</html>
