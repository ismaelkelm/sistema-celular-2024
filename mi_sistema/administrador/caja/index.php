<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar registros de caja
$query = "SELECT * FROM caja";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Movimientos de Caja</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Movimiento</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo Movimiento</th>
                <th>Monto</th>
                <th>Descripción</th>
                <th>Fecha Movimiento</th>
                <th>ID Documento</th>
                <th>Tipo Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_caja']); ?></td>
                <td><?php echo htmlspecialchars($row['tipo_movimiento']); ?></td>
                <td><?php echo htmlspecialchars(number_format($row['monto'], 2)); ?></td>
                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_movimiento']); ?></td>
                <td><?php echo htmlspecialchars($row['id_documento']); ?></td>
                <td><?php echo htmlspecialchars($row['tipo_documento']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_caja']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_caja']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">Eliminar</a>
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
