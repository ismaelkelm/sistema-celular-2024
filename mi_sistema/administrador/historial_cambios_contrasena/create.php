<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $fecha_cambio = $_POST['fecha_cambio'];
    $motivo = $_POST['motivo'];

    $query = "INSERT INTO historial_cambios_contrasena (id_usuario, fecha_cambio, motivo) 
              VALUES ('$id_usuario', '$fecha_cambio', '$motivo')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Cambio de Contraseña</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_usuario">ID Usuario:</label>
            <input type="number" id="id_usuario" name="id_usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_cambio">Fecha Cambio:</label>
            <input type="date" id="fecha_cambio" name="fecha_cambio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea id="motivo" name="motivo" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
