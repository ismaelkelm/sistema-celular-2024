<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $iconos = mysqli_real_escape_string($conn, $_POST['iconos']);

    $query = "INSERT INTO roles (nombre, iconos) VALUES ('$nombre', '$iconos')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el rol: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Rol</h1>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="iconos">Icono</label>
            <input type="text" class="form-control" id="iconos" name="iconos" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
