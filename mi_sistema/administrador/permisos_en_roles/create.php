<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roles_id_roles = mysqli_real_escape_string($conn, $_POST['roles_id_roles']);
    $Permisos_idPermisos = mysqli_real_escape_string($conn, $_POST['Permisos_idPermisos']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    $query = "INSERT INTO permisos_en_roles (roles_id_roles, Permisos_idPermisos, estado) VALUES ('$roles_id_roles', '$Permisos_idPermisos', '$estado')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el permiso en rol: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Permiso en Rol</h1>
    <form method="POST">
        <div class="form-group">
            <label for="roles_id_roles">Role ID</label>
            <input type="number" class="form-control" id="roles_id_roles" name="roles_id_roles" required>
        </div>
        <div class="form-group">
            <label for="Permisos_idPermisos">Permiso ID</label>
            <input type="number" class="form-control" id="Permisos_idPermisos" name="Permisos_idPermisos" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
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
