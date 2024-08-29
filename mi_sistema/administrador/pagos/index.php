<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar pagos
$query = "SELECT * FROM pagos";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Pagos</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Pago</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de Pago</th>
                <th>Monto</th>
                <th>Tipo de Pago</th>
                <th>Factura Compra</th>
                <th>Factura Venta Reparación</th>
                <th>Factura Venta Accesorio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_pagos']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_pago']); ?></td>
                <td><?php echo htmlspecialchars(number_format($row['monto'], 2)); ?></td>
                <td><?php echo htmlspecialchars($row['id_tipo_pago']); ?></td>
                <td><?php echo htmlspecialchars($row['id_facturas_compra']); ?></td>
                <td><?php echo htmlspecialchars($row['id_facturas_venta_reparacion']); ?></td>
                <td><?php echo htmlspecialchars($row['id_factura_venta_accesorio']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_pagos']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_pagos']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
