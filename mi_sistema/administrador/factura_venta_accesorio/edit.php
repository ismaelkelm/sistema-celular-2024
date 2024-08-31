<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de factura de venta accesorio no especificado.');
}

$id = $_GET['id'];

// Consultar la factura de venta accesorio
$query = "SELECT * FROM factura_venta_accesorio WHERE id_factura_venta_accesorio = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Factura de venta accesorio no encontrada.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_factura = $_POST['numero_factura'];
    $fecha = $_POST['fecha'];

    // Actualizar factura de venta accesorio
    $query = "UPDATE factura_venta_accesorio SET numero_factura = ?, fecha = ? WHERE id_factura_venta_accesorio = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $numero_factura, $fecha, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de facturas de venta accesorio
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
    <title>Editar Factura de Venta Accesorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Factura de Venta Accesorio</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="numero_factura" class="form-label">Número de Factura</label>
            <input type="text" class="form-control" id="numero_factura" name="numero_factura" value="<?php echo htmlspecialchars($row['numero_factura']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo htmlspecialchars($row['fecha']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
