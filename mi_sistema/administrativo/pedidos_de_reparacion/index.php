<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar pedidos
$query = "SELECT * FROM pedidos_de_reparacion";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <<a href="javascript:window.history.back();" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Pedidos de Reparación</h1>
    <!-- Botón para iniciar el flujo de registro de un nuevo pedido -->
    <a href="/administrativo/pedidos_de_reparacion/registrar_cliente.php" class="btn btn-primary mb-3">Agregar Pedido</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Dispositivo</th>
                <th>Fecha de Pedido</th>
                <th>Estado</th>
                <th>Número de Orden</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?></td>
                <td><?php echo htmlspecialchars($row['id_clientes']); ?></td>
                <td><?php echo htmlspecialchars($row['id_dispositivos']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_de_pedido']); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td><?php echo htmlspecialchars($row['numero_orden']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_pedidos_de_reparacion']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
