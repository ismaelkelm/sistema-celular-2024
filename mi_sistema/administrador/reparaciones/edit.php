<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $id_dispositivos = mysqli_real_escape_string($conn, $_POST['id_dispositivos']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $fecha_de_reparacion = mysqli_real_escape_string($conn, $_POST['fecha_de_reparacion']);

    $query = "UPDATE reparaciones SET id_dispositivos='$id_dispositivos', descripcion='$descripcion', estado='$estado', fecha_de_reparacion='$fecha_de_reparacion' WHERE id_reparaciones='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar la reparación: " . mysqli_error($conn));
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM reparaciones WHERE id_reparaciones='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Reparación</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_reparaciones']); ?>">
        <div class="form-group">
            <label for="id_dispositivos">ID Dispositivo</label>
            <input type="number" class="form-control" id="id_dispositivos" name="id_dispositivos" value="<?php echo htmlspecialchars($row['id_dispositivos']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?php echo htmlspecialchars($row['estado']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_reparacion">Fecha de Reparación</label>
            <input type="date" class="form-control" id="fecha_de_reparacion" name="fecha_de_reparacion" value="<?php echo htmlspecialchars($row['fecha_de_reparacion']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
