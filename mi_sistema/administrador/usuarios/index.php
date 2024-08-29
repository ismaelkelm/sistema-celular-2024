<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar usuarios
$query = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Usuarios</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Usuario</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_usuarios']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                <td><?php echo htmlspecialchars($row['correo_electronico']); ?></td>
                <td><?php 
                    // Obtener descripción del rol
                    $roleQuery = "SELECT descripcion FROM roles WHERE id_roles = ?";
                    $roleStmt = $conn->prepare($roleQuery);
                    $roleStmt->bind_param("i", $row['id_roles']);
                    $roleStmt->execute();
                    $roleResult = $roleStmt->get_result();
                    $roleRow = $roleResult->fetch_assoc();
                    echo htmlspecialchars($roleRow['descripcion']);
                ?></td>
                <td>
                    <a href="edit.php?id_usuarios=<?php echo htmlspecialchars($row['id_usuarios']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id_usuarios=<?php echo htmlspecialchars($row['id_usuarios']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
