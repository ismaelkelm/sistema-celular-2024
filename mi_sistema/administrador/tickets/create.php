<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = mysqli_real_escape_string($conn, $_POST['id_cliente']);
    $id_dispositivos = mysqli_real_escape_string($conn, $_POST['id_dispositivos']);
    $fecha_de_ticket = mysqli_real_escape_string($conn, $_POST['fecha_de_ticket']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    $query = "INSERT INTO tickets (id_cliente, id_dispositivos, fecha_de_ticket, estado) VALUES ('$id_cliente', '$id_dispositivos', '$fecha_de_ticket', '$estado')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el ticket: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Ticket</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_cliente">ID Cliente</label>
            <input type="number" class="form-control" id="id_cliente" name="id_cliente" required>
        </div>
        <div class="form-group">
            <label for="id_dispositivos">ID Dispositivo</label>
            <input type="number" class="form-control" id="id_dispositivos" name="id_dispositivos" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_ticket">Fecha de Ticket</label>
            <input type="date" class="form-control" id="fecha_de_ticket" name="fecha_de_ticket" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Pagado">Pagado</option>
                <option value="Reembolsado">Reembolsado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
