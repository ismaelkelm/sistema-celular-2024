<?php
// ver_estado.php
include_once '../privado/configuracion/bd.php';

if (isset($_GET['numero_orden'])) {
    $numeroOrden = $_GET['numero_orden'];
    $estado = obtenerEstadoReparacion($numeroOrden);
} else {
    $mensaje = "Número de orden no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de Reparación</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Estado de Reparación</h1>
    <?php if (isset($estado)) echo "<p>Estado: $estado</p>"; ?>
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
</body>
</html>
