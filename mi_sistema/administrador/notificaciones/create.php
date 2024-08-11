<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuarios = mysqli_real_escape_string($conn, $_POST['id_usuarios']);
    $mensaje = mysqli_real_escape_string($conn, $_POST['mensaje']);
    $fecha_de_envío = mysqli_real_escape_string($conn, $_POST['fecha_de_envío']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    $query = "INSERT INTO notificaciones (id_usuarios, mensaje, fecha_de_envío, estado)
              VALUES ('$id_usuarios', '$mensaje', '$fecha_de_envío', '$estado')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar la notificación: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Notificación</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_usuarios">ID Usuario</label>
            <input type="number" class="form-control" id="id_usuarios" name="id_usuarios" required>
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_de_envío">Fecha de Envío</label>
            <input type="date" class="form-control" id="fecha_de_envío" name="fecha_de_envío" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Leído">Leído</option>
                <option value="No Leído">No Leído</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
