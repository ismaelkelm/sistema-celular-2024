<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roles_id_roles = mysqli_real_escape_string($conn, $_POST['roles_id_roles']);
    $Permisos_idPermisos = mysqli_real_escape_string($conn, $_POST['Permisos_idPermisos']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    $query = "UPDATE permisos_en_roles SET estado='$estado' WHERE roles_id_roles='$roles_id_roles' AND Permisos_idPermisos='$Permisos_idPermisos'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el permiso en rol: " . mysqli_error($conn));
    }
} else {
    $roles_id_roles = mysqli_real_escape_string($conn, $_GET['roles_id']);
    $Permisos_idPermisos = mysqli_real_escape_string($conn, $_GET['permiso_id']);
    $query = "SELECT * FROM permisos_en_roles WHERE roles_id_roles='$roles_id_roles' AND Permisos_idPermisos='$Permisos_idPermisos'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Permiso en Rol</h1>
    <form method="POST">
        <input type="hidden" name="roles_id_roles" value="<?php echo htmlspecialchars($row['roles_id_roles']); ?>">
        <input type="hidden" name="Permisos_idPermisos" value="<?php echo htmlspecialchars($row['Permisos_idPermisos']); ?>">
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1" <?php echo $row['estado'] ? 'selected' : ''; ?>>Activo</option>
                <option value="0" <?php echo !$row['estado'] ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
