<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de factura de venta reparación no especificado.');
}

$id = $_GET['id'];

// Consultar la factura de venta reparación
$query = "SELECT * FROM facturas_venta_reparacion WHERE id_facturas_venta_reparacion = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Factura de venta reparación no encontrada.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha_de_emision = $_POST['fecha_de_emision'];
    $subtotal = $_POST['subtotal'];
    $impuestos = $_POST['impuestos'];
    $total = $_POST['total'];

    // Actualizar factura de venta reparación
    $query = "UPDATE facturas_venta_reparacion SET fecha_de_emision = ?, subtotal = ?, impuestos = ?, total = ? WHERE id_facturas_venta_reparacion = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdddi", $fecha_de_emision, $subtotal, $impuestos, $total, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de facturas de venta reparación
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
    <title>Editar Factura de Venta Reparación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Factura de Venta Reparación</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="fecha_de_emision" class="form-label">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_de_emision" name="fecha_de_emision" value="<?php echo htmlspecialchars($row['fecha_de_emision']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" class="form-control" id="subtotal" name="subtotal" step="0.01" value="<?php echo htmlspecialchars($row['subtotal']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="impuestos" class="form-label">Impuestos</label>
            <input type="number" class="form-control" id="impuestos" name="impuestos" step="0.01" value="<?php echo htmlspecialchars($row['impuestos']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" step="0.01" value="<?php echo htmlspecialchars($row['total']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
