<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $precio_total = $_POST['precio_total'];
    $id_factura_venta_accesorio = $_POST['id_factura_venta_accesorio'];
    $id_accesorios_y_componentes = $_POST['id_accesorios_y_componentes'];

    // Insertar nuevo detalle de ventas de accesorios
    $query = "INSERT INTO detalle_ventas_accesorios (cantidad, precio_total, id_factura_venta_accesorio, id_accesorios_y_componentes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idii", $cantidad, $precio_total, $id_factura_venta_accesorio, $id_accesorios_y_componentes);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de detalles de ventas de accesorios
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
    <title>Agregar Detalle de Venta de Accesorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Detalle de Venta de Accesorios</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="mb-3">
            <label for="precio_total" class="form-label">Precio Total</label>
            <input type="number" class="form-control" id="precio_total" name="precio_total" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="id_factura_venta_accesorio" class="form-label">ID Factura Venta Accesorio</label>
            <input type="number" class="form-control" id="id_factura_venta_accesorio" name="id_factura_venta_accesorio" required>
        </div>
        <div class="mb-3">
            <label for="id_accesorios_y_componentes" class="form-label">ID Accesorio/Componente</label>
            <input type="number" class="form-control" id="id_accesorios_y_componentes" name="id_accesorios_y_componentes" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
