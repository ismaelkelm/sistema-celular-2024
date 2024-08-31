<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar historial de cambios de contraseña
$query = "SELECT * FROM historial_cambios_contrasena";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Historial de Cambios de Contraseña</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Usuario</th>
                <th>Fecha de Cambio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_historial']); ?></td>
                <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_cambio']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_historial']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_historial']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
