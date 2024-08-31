<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el ID está en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID de notificación no especificado.');
}

$id = $_GET['id'];

// Consultar la notificación
$query = "SELECT * FROM notificaciones WHERE id_notificaciones = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Notificación no encontrada.');
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $mensaje = $_POST['mensaje'];
    $fecha_envio = $_POST['fecha_envio'];

    // Actualizar notificación
    $query = "UPDATE notificaciones SET id_usuario = ?, mensaje = ?, fecha_envio = ? WHERE id_notificaciones = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issi", $id_usuario, $mensaje, $fecha_envio, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de notificaciones
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
    <title>Editar Notificación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Notificación</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="id_usuario" class="form-label">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars($row['id_usuario']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required><?php echo htmlspecialchars($row['mensaje']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_envio" class="form-label">Fecha de Envío</label>
            <input type="datetime-local" class="form-control" id="fecha_envio" name="fecha_envio" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($row['fecha_envio']))); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>
