<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cambio = $_POST['id_cambio'];
    $id_usuario = $_POST['id_usuario'];
    $fecha_cambio = $_POST['fecha_cambio'];
    $motivo = $_POST['motivo'];

    $query = "UPDATE historial_cambios_contrasena 
              SET id_usuario='$id_usuario', fecha_cambio='$fecha_cambio', motivo='$motivo'
              WHERE id_cambio=$id_cambio";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    $id_cambio = $_GET['id'];
    $query = "SELECT * FROM historial_cambios_contrasena WHERE id_cambio=$id_cambio";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Cambio de Contraseña</h1>
    <form method="post" action="">
        <input type="hidden" name="id_cambio" value="<?php echo htmlspecialchars($row['id_cambio']); ?>">
        <div class="form-group">
            <label for="id_usuario">ID Usuario:</label>
            <input type="number" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo htmlspecialchars($row['id_usuario']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_cambio">Fecha Cambio:</label>
            <input type="date" id="fecha_cambio" name="fecha_cambio" class="form-control" value="<?php echo htmlspecialchars($row['fecha_cambio']); ?>" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea id="motivo" name="motivo" class="form-control" required><?php echo htmlspecialchars($row['motivo']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
