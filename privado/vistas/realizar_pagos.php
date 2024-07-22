<?php
// realizar_pagos.php
include_once '../privado/configuracion/bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroOrden = $_POST['numero_orden'];
    $monto = $_POST['monto'];

    if (realizarPago($numeroOrden, $monto)) {
        $mensaje = "Pago realizado con éxito.";
    } else {
        $mensaje = "No se pudo realizar el pago.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pago</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Realizar Pago</h1>
    <form method="post">
        <label for="numero_orden">Número de Orden:</label>
        <input type="text" id="numero_orden" name="numero_orden" required>
        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" required>
        <button type="submit">Realizar Pago</button>
        <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    </form>
</body>
</html>
