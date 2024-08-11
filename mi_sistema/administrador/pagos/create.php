<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_recibo = mysqli_real_escape_string($conn, $_POST['id_recibo']);
    $monto = mysqli_real_escape_string($conn, $_POST['monto']);
    $fecha_pago = mysqli_real_escape_string($conn, $_POST['fecha_pago']);

    $query = "INSERT INTO pagos (id_recibo, monto, fecha_pago)
              VALUES ('$id_recibo', '$monto', '$fecha_pago')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el pago: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Pago</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_recibo">ID Recibo</label>
            <input type="number" class="form-control" id="id_recibo" name="id_recibo" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="fecha_pago">Fecha de Pago</label>
            <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
