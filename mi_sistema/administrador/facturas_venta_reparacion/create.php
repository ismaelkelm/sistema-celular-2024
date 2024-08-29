<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_de_emision = $_POST['fecha_de_emision'];
    $subtotal = $_POST['subtotal'];
    $impuestos = $_POST['impuestos'];
    $total = $_POST['total'];

    // Insertar nueva factura de venta reparación
    $query = "INSERT INTO facturas_venta_reparacion (fecha_de_emision, subtotal, impuestos, total) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sddd", $fecha_de_emision, $subtotal, $impuestos, $total);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de facturas de venta reparación
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
    <title>Agregar Factura de Venta Reparación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Factura de Venta Reparación</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="fecha_de_emision" class="form-label">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_de_emision" name="fecha_de_emision" required>
        </div>
        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" class="form-control" id="subtotal" name="subtotal" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="impuestos" class="form-label">Impuestos</label>
            <input type="number" class="form-control" id="impuestos" name="impuestos" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
