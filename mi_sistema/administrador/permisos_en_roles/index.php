<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar permisos en roles
$query = "SELECT * FROM permisos_en_roles";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Permisos en Roles</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Permiso en Rol</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Role ID</th>
                <th>Permiso ID</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['roles_id_roles']); ?></td>
                <td><?php echo htmlspecialchars($row['Permisos_idPermisos']); ?></td>
                <td><?php echo htmlspecialchars($row['estado'] ? 'Activo' : 'Inactivo'); ?></td>
                <td>
                    <a href="edit.php?roles_id=<?php echo htmlspecialchars($row['roles_id_roles']); ?>&permiso_id=<?php echo htmlspecialchars($row['Permisos_idPermisos']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?roles_id=<?php echo htmlspecialchars($row['roles_id_roles']); ?>&permiso_id=<?php echo htmlspecialchars($row['Permisos_idPermisos']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
