<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_pago = $_POST['fecha_pago'];
    $monto = $_POST['monto'];
    $id_tipo_pago = $_POST['id_tipo_pago'];
    $id_facturas_compra = $_POST['id_facturas_compra'];
    $id_facturas_venta_reparacion = $_POST['id_facturas_venta_reparacion'];
    $id_factura_venta_accesorio = $_POST['id_factura_venta_accesorio'];

    // Insertar nuevo pago
    $query = "INSERT INTO pagos (fecha_pago, monto, id_tipo_pago, id_facturas_compra, id_facturas_venta_reparacion, id_factura_venta_accesorio) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdiiii", $fecha_pago, $monto, $id_tipo_pago, $id_facturas_compra, $id_facturas_venta_reparacion, $id_factura_venta_accesorio);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de pagos
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
    <title>Agregar Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Pago</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="fecha_pago" class="form-label">Fecha de Pago</label>
            <input type="datetime-local" class="form-control" id="fecha_pago" name="fecha_pago" required>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
        </div>
        <div class="mb-3">
            <label for="id_tipo_pago" class="form-label">Tipo de Pago</label>
            <input type="number" class="form-control" id="id_tipo_pago" name="id_tipo_pago" required>
        </div>
        <div class="mb-3">
            <label for="id_facturas_compra" class="form-label">Factura Compra</label>
            <input type="number" class="form-control" id="id_facturas_compra" name="id_facturas_compra" required>
        </div>
        <div class="mb-3">
            <label for="id_facturas_venta_reparacion" class="form-label">Factura Venta Reparación</label>
            <input type="number" class="form-control" id="id_facturas_venta_reparacion" name="id_facturas_venta_reparacion" required>
        </div>
        <div class="mb-3">
            <label for="id_factura_venta_accesorio" class="form-label">Factura Venta Accesorio</label>
            <input type="number" class="form-control" id="id_factura_venta_accesorio" name="id_factura_venta_accesorio" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
