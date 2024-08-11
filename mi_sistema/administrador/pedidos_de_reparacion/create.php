<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_clientes = mysqli_real_escape_string($conn, $_POST['id_clientes']);
    $id_dispositivos = mysqli_real_escape_string($conn, $_POST['id_dispositivos']);
    $fecha_de_pedido = mysqli_real_escape_string($conn, $_POST['fecha_de_pedido']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $numero_orden = mysqli_real_escape_string($conn, $_POST['numero_orden']);

    $query = "INSERT INTO pedidos_de_reparacion (id_clientes, id_dispositivos, fecha_de_pedido, estado, numero_orden)
              VALUES ('$id_clientes', '$id_dispositivos', '$fecha_de_pedido', '$estado', '$numero_orden')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el pedido: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Pedido</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_clientes">ID Cliente</label>
            <input type="number" class="form-control" id="id_clientes" name="id_clientes" required>
        </div>
        <div class="form-group">
            <label for="id_dispositivos">ID Dispositivo</label>
            <input type="number" class="form-control" id="id_dispositivos" name="id_dispositivos" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_pedido">Fecha de Pedido</label>
            <input type="date" class="form-control" id="fecha_de_pedido" name="fecha_de_pedido" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="form-group">
            <label for="numero_orden">Número de Orden</label>
            <input type="text" class="form-control" id="numero_orden" name="numero_orden" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
