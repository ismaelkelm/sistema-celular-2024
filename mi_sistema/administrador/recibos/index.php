<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar recibos
$query = "SELECT * FROM recibos";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../../index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Recibos</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Recibo</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pago ID</th>
                <th>Fecha de Emisión</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['pago_id']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_de_emisión']); ?></td>
                <td><?php echo htmlspecialchars($row['monto']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('../../includes/footer.php'); ?>
