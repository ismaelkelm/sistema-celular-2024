<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $especialidad = mysqli_real_escape_string($conn, $_POST['especialidad']);
    $id_usuario = mysqli_real_escape_string($conn, $_POST['id_usuario']);

    $query = "INSERT INTO tecnicos (nombre, especialidad, id_usuario) VALUES ('$nombre', '$especialidad', '$id_usuario')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el técnico: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Técnico</h1>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="especialidad">Especialidad</label>
            <input type="text" class="form-control" id="especialidad" name="especialidad" required>
        </div>
        <div class="form-group">
            <label for="id_usuario">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuario" name="id_usuario" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
