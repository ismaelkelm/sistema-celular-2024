<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de pago no especificado.');
}

$id = $_GET['id'];

// Consultar el pago
$query = "SELECT * FROM pagos WHERE id_pagos = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Pago no encontrado.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_pago = $_POST['fecha_pago'];
    $monto = $_POST['monto'];
    $id_tipo_pago = $_POST['id_tipo_pago'];
    $id_facturas_compra = $_POST['id_facturas_compra'];
    $id_facturas_venta_reparacion = $_POST['id_facturas_venta_reparacion'];
    $id_factura_venta_accesorio = $_POST['id_factura_venta_accesorio'];

    // Actualizar pago
    $query = "UPDATE pagos SET fecha_pago = ?, monto = ?, id_tipo_pago = ?, id_facturas_compra = ?, id_facturas_venta_reparacion = ?, id_factura_venta_accesorio = ? WHERE id_pagos = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdiiiii", $fecha_pago, $monto, $id_tipo_pago, $id_facturas_compra, $id_facturas_venta_reparacion, $id_factura_venta_accesorio, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de pagos
        exit();
    } else {
        die("Error al actualizar: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Pago</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="fecha_pago" class="form-label">Fecha de Pago</label>
            <input type="datetime-local" class="form-control" id="fecha_pago" name="fecha_pago" value="<?php echo htmlspecialchars($row['fecha_pago']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="<?php echo htmlspecialchars($row['monto']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_tipo_pago" class="form-label">ID Tipo de Pago</label>
            <input type="number" class="form-control" id="id_tipo_pago" name="id_tipo_pago" value="<?php echo htmlspecialchars($row['id_tipo_pago']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_facturas_compra" class="form-label">ID Factura Compra</label>
            <input type="number" class="form-control" id="id_facturas_compra" name="id_facturas_compra" value="<?php echo htmlspecialchars($row['id_facturas_compra']); ?>">
        </div>
        <div class="mb-3">
            <label for="id_facturas_venta_reparacion" class="form-label">ID Factura Venta Reparación</label>
            <input type="number" class="form-control" id="id_facturas_venta_reparacion" name="id_facturas_venta_reparacion" value="<?php echo htmlspecialchars($row['id_facturas_venta_reparacion']); ?>">
        </div>
        <div class="mb-3">
            <label for="id_factura_venta_accesorio" class="form-label">ID Factura Venta Accesorio</label>
            <input type="number" class="form-control" id="id_factura_venta_accesorio" name="id_factura_venta_accesorio" value="<?php echo htmlspecialchars($row['id_factura_venta_accesorio']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
