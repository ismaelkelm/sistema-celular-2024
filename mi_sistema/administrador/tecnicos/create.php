<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar áreas técnicas para el desplegable
$query_areas = "SELECT * FROM area_tecnico";
$result_areas = mysqli_query($conn, $query_areas);
if (!$result_areas) {
    die("Error en la consulta de áreas técnicas: " . mysqli_error($conn));
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $id_usuario = $_POST['id_usuario'];
    $id_area_tecnico = $_POST['id_area_tecnico'];

    // Insertar nuevo técnico
    $query = "INSERT INTO tecnicos (nombre, id_usuario, id_area_tecnico) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $nombre, $id_usuario, $id_area_tecnico);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de técnicos
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
    <title>Agregar Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Técnico</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="id_usuario" class="form-label">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuario" name="id_usuario" required>
        </div>
        <div class="mb-3">
            <label for="id_area_tecnico" class="form-label">Área Técnica</label>
            <select class="form-select" id="id_area_tecnico" name="id_area_tecnico" required>
                <?php while ($area = mysqli_fetch_assoc($result_areas)) { ?>
                <option value="<?php echo htmlspecialchars($area['id_area_tecnico']); ?>">
                    <?php echo htmlspecialchars($area['nombre']); ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
