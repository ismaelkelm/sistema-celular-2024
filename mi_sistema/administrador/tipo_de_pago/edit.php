<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id_tipo_de_pago'])) {
    die('ID de tipo de pago no especificado.');
}

$id_tipo_de_pago = $_GET['id_tipo_de_pago'];

// Consultar el tipo de pago
$query = "SELECT * FROM tipo_de_pago WHERE id_tipo_de_pago = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_tipo_de_pago);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Tipo de pago no encontrado.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];

    // Actualizar tipo de pago
    $query = "UPDATE tipo_de_pago SET descripcion = ? WHERE id_tipo_de_pago = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $descripcion, $id_tipo_de_pago);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de tipos de pago
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
    <title>Editar Tipo de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Tipo de Pago</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="id_tipo_de_pago" class="form-label">ID Tipo de Pago</label>
            <input type="text" class="form-control" id="id_tipo_de_pago" name="id_tipo_de_pago" value="<?php echo htmlspecialchars($row['id_tipo_de_pago']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
