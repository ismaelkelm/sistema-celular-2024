<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $id_factura_compra = $_POST['id_factura_compra'];
    $id_accesorios_y_componentes = $_POST['id_accesorios_y_componentes'];

    // Insertar nuevo detalle de compra
    $query = "INSERT INTO detalle_compra (cantidad, precio_unitario, id_factura_compra, id_accesorios_y_componentes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idii", $cantidad, $precio_unitario, $id_factura_compra, $id_accesorios_y_componentes);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de detalles de compra
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
    <title>Agregar Detalle de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Detalle de Compra</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="id_factura_compra" class="form-label">ID Factura Compra</label>
            <input type="number" class="form-control" id="id_factura_compra" name="id_factura_compra" required>
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
