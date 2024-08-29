<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de detalle de reparación no especificado.');
}

$id = $_GET['id'];

// Consultar el detalle de reparación
$query = "SELECT * FROM detalle_reparaciones WHERE id_detalle_reparaciones = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Detalle de reparación no encontrado.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $id_accesorios_y_componentes = $_POST['id_accesorios_y_componentes'];
    $id_pedidos_de_reparacion = $_POST['id_pedidos_de_reparacion'];

    // Actualizar detalle de reparación
    $query = "UPDATE detalle_reparaciones SET cantidad = ?, precio_unitario = ?, id_accesorios_y_componentes = ?, id_pedidos_de_reparacion = ? WHERE id_detalle_reparaciones = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idiii", $cantidad, $precio_unitario, $id_accesorios_y_componentes, $id_pedidos_de_reparacion, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de detalles de reparación
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
    <title>Editar Detalle de Reparación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Detalle de Reparación</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($row['cantidad']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" value="<?php echo htmlspecialchars(number_format($row['precio_unitario'], 2)); ?>" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="id_accesorios_y_componentes" class="form-label">ID Accesorio/Componente</label>
            <input type="number" class="form-control" id="id_accesorios_y_componentes" name="id_accesorios_y_componentes" value="<?php echo htmlspecialchars($row['id_accesorios_y_componentes']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_pedidos_de_reparacion" class="form-label">ID Pedido de Reparación</label>
            <input type="number" class="form-control" id="id_pedidos_de_reparacion" name="id_pedidos_de_reparacion" value="<?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
