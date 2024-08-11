<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $especialidad = mysqli_real_escape_string($conn, $_POST['especialidad']);
    $id_usuario = mysqli_real_escape_string($conn, $_POST['id_usuario']);

    $query = "UPDATE tecnicos SET nombre='$nombre', especialidad='$especialidad', id_usuario='$id_usuario' WHERE id_tecnicos='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el técnico: " . mysqli_error($conn));
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM tecnicos WHERE id_tecnicos='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Técnico</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_tecnicos']); ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="especialidad">Especialidad</label>
            <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?php echo htmlspecialchars($row['especialidad']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_usuario">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo htmlspecialchars($row['id_usuario']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
