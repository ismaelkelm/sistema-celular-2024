<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_factura = $_POST['numero_factura'];
    $fecha = $_POST['fecha'];

    // Insertar nueva factura de venta accesorio
    $query = "INSERT INTO factura_venta_accesorio (numero_factura, fecha) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $numero_factura, $fecha);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de facturas de venta accesorio
        exit();
    } else {
        die("Error al insertar: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Factura de Venta Accesorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Factura de Venta Accesorio</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="numero_factura" class="form-label">Número de Factura</label>
            <input type="text" class="form-control" id="numero_factura" name="numero_factura" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
