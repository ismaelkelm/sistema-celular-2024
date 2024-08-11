<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dispositivos = mysqli_real_escape_string($conn, $_POST['id_dispositivos']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $fecha_de_reparacion = mysqli_real_escape_string($conn, $_POST['fecha_de_reparacion']);

    $query = "INSERT INTO reparaciones (id_dispositivos, descripcion, estado, fecha_de_reparacion) VALUES ('$id_dispositivos', '$descripcion', '$estado', '$fecha_de_reparacion')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar la reparación: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Reparación</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_dispositivos">ID Dispositivo</label>
            <input type="number" class="form-control" id="id_dispositivos" name="id_dispositivos" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_reparacion">Fecha de Reparación</label>
            <input type="date" class="form-control" id="fecha_de_reparacion" name="fecha_de_reparacion" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
