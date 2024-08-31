<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de historial no especificado.');
}

$id = $_GET['id'];

// Consultar el historial de cambios de contraseña
$query = "SELECT * FROM historial_cambios_contrasena WHERE id_historial = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Historial no encontrado.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $fecha_cambio = $_POST['fecha_cambio'];

    // Actualizar historial de cambio de contraseña
    $query = "UPDATE historial_cambios_contrasena SET id_usuario = ?, fecha_cambio = ? WHERE id_historial = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $id_usuario, $fecha_cambio, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de historial de cambios de contraseña
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
    <title>Editar Historial de Cambios de Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Historial de Cambios de Contraseña</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="id_usuario" class="form-label">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars($row['id_usuario']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha_cambio" class="form-label">Fecha de Cambio</label>
            <input type="datetime-local" class="form-control" id="fecha_cambio" name="fecha_cambio" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($row['fecha_cambio']))); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
