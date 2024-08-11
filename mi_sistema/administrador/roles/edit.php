<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $iconos = mysqli_real_escape_string($conn, $_POST['iconos']);

    $query = "UPDATE roles SET nombre='$nombre', iconos='$iconos' WHERE id_roles='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el rol: " . mysqli_error($conn));
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM roles WHERE id_roles='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Rol</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_roles']); ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="iconos">Icono</label>
            <input type="text" class="form-control" id="iconos" name="iconos" value="<?php echo htmlspecialchars($row['iconos']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
