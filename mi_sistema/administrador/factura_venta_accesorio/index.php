<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar facturas venta accesorio
$query = "SELECT * FROM factura_venta_accesorio";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Facturas de Venta de Accesorios</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Factura</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de Factura</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_factura_venta_accesorio']); ?></td>
                <td><?php echo htmlspecialchars($row['numero_factura']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_factura_venta_accesorio']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_factura_venta_accesorio']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
