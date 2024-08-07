<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar usuarios
$query = "SELECT * FROM usuarios ORDER BY id_roles ASC";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="create.php" class="btn btn-primary mb-3">Agregar Usuario</a>
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Lista de Usuarios</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Email</th>
                <th>ID Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_usuarios']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['DNI']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['id_roles']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_usuarios']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_usuarios']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
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
