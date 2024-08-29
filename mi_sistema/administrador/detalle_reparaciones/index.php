<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar detalles de reparaciones
$query = "SELECT * FROM detalle_reparaciones";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Detalles de Reparaciones</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Detalle</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>ID Accesorio/Componente</th>
                <th>ID Pedido de Reparación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_detalle_reparaciones']); ?></td>
                <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                <td><?php echo htmlspecialchars(number_format($row['precio_unitario'], 2)); ?></td>
                <td><?php echo htmlspecialchars($row['id_accesorios_y_componentes']); ?></td>
                <td><?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_detalle_reparaciones']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_detalle_reparaciones']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
