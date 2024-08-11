<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPermisos = mysqli_real_escape_string($conn, $_POST['idPermisos']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

    $query = "UPDATE permisos SET descripcion='$descripcion' WHERE idPermisos='$idPermisos'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el permiso: " . mysqli_error($conn));
    }
} else {
    $idPermisos = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM permisos WHERE idPermisos='$idPermisos'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Permiso</h1>
    <form method="POST">
        <input type="hidden" name="idPermisos" value="<?php echo htmlspecialchars($row['idPermisos']); ?>">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
