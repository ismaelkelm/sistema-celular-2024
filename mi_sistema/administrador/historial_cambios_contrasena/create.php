<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $fecha_cambio = $_POST['fecha_cambio'];

    // Insertar nuevo historial de cambio de contraseña
    $query = "INSERT INTO historial_cambios_contrasena (id_usuario, fecha_cambio) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $id_usuario, $fecha_cambio);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de historial de cambios de contraseña
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
    <title>Agregar Historial de Cambios de Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Historial de Cambios de Contraseña</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="id_usuario" class="form-label">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuario" name="id_usuario" required>
        </div>
        <div class="mb-3">
            <label for="fecha_cambio" class="form-label">Fecha de Cambio</label>
            <input type="datetime-local" class="form-control" id="fecha_cambio" name="fecha_cambio" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
