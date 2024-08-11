<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar ventas
$query = "SELECT * FROM ventas_accesorios";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Ventas de Accesorios</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Venta</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Accesorio</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
                <th>Fecha de Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                // Obtener el nombre del cliente
                $clienteQuery = "SELECT nombre FROM clientes WHERE id_clientes = " . $row['id_clientes'];
                $clienteResult = mysqli_query($conn, $clienteQuery);
                $clienteRow = mysqli_fetch_assoc($clienteResult);

                // Obtener el nombre del accesorio
                $accesorioQuery = "SELECT nombre FROM accesorios WHERE id_accesorios = " . $row['id_accesorios'];
                $accesorioResult = mysqli_query($conn, $accesorioQuery);
                $accesorioRow = mysqli_fetch_assoc($accesorioResult);
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_ventas_accesorios']); ?></td>
                <td><?php echo htmlspecialchars($clienteRow['nombre']); ?></td>
                <td><?php echo htmlspecialchars($accesorioRow['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                <td><?php echo htmlspecialchars($row['precio_total']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_venta']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_ventas_accesorios']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_ventas_accesorios']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
