<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $id_cliente = mysqli_real_escape_string($conn, $_POST['id_cliente']);
    $id_dispositivos = mysqli_real_escape_string($conn, $_POST['id_dispositivos']);
    $fecha_de_ticket = mysqli_real_escape_string($conn, $_POST['fecha_de_ticket']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    $query = "UPDATE tickets SET id_cliente='$id_cliente', id_dispositivos='$id_dispositivos', fecha_de_ticket='$fecha_de_ticket', estado='$estado' WHERE id_tickets='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el ticket: " . mysqli_error($conn));
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM tickets WHERE id_tickets='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Ticket</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_tickets']); ?>">
        <div class="form-group">
            <label for="id_cliente">ID Cliente</label>
            <input type="number" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo htmlspecialchars($row['id_cliente']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_dispositivos">ID Dispositivo</label>
            <input type="number" class="form-control" id="id_dispositivos" name="id_dispositivos" value="<?php echo htmlspecialchars($row['id_dispositivos']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_ticket">Fecha de Ticket</label>
            <input type="date" class="form-control" id="fecha_de_ticket" name="fecha_de_ticket" value="<?php echo htmlspecialchars($row['fecha_de_ticket']); ?>" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Pendiente" <?php echo $row['estado'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="Pagado" <?php echo $row['estado'] == 'Pagado' ? 'selected' : ''; ?>>Pagado</option>
                <option value="Reembolsado" <?php echo $row['estado'] == 'Reembolsado' ? 'selected' : ''; ?>>Reembolsado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
