<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar tickets
$query = "SELECT * FROM tickets";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="../administrador.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Tickets</h1>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Ticket</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Cliente</th>
                <th>ID Dispositivo</th>
                <th>Fecha de Ticket</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_tickets']); ?></td>
                <td><?php echo htmlspecialchars($row['id_cliente']); ?></td>
                <td><?php echo htmlspecialchars($row['id_dispositivos']); ?></td>
                <td><?php echo htmlspecialchars($row['fecha_de_ticket']); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo htmlspecialchars($row['id_tickets']); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($row['id_tickets']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
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
