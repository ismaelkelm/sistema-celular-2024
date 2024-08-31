<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar técnicos
$query = "SELECT t.id_tecnicos, t.nombre, t.id_usuario, t.id_area_tecnico, a.nombre AS area_nombre
          FROM tecnicos t
          JOIN area_tecnico a ON t.id_area_tecnico = a.id_area_tecnico";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Técnicos</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Técnico</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>ID Usuario</th>
                <th>Área Técnica</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_tecnicos']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
                <td><?php echo htmlspecialchars($row['area_nombre']); ?></td>
                <td>
                    <a href="edit.php?id_tecnicos=<?php echo htmlspecialchars($row['id_tecnicos']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id_tecnicos=<?php echo htmlspecialchars($row['id_tecnicos']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
