<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idMovimiento = $_POST['idMovimiento'];
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $fecha_movimiento = $_POST['fecha_movimiento'];
    $id_ticket = $_POST['id_ticket'];
    $id_recibo = $_POST['id_recibo'];
    $id_factura = $_POST['id_factura'];

    $query = "UPDATE movimientos_financieros 
              SET tipo_movimiento='$tipo_movimiento', monto='$monto', descripcion='$descripcion', fecha_movimiento='$fecha_movimiento', id_ticket='$id_ticket', id_recibo='$id_recibo', id_factura='$id_factura'
              WHERE idMovimiento=$idMovimiento";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    $idMovimiento = $_GET['id'];
    $query = "SELECT * FROM movimientos_financieros WHERE idMovimiento=$idMovimiento";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Movimiento Financiero</h1>
    <form method="post" action="">
        <input type="hidden" name="idMovimiento" value="<?php echo htmlspecialchars($row['idMovimiento']); ?>">
        <div class="form-group">
            <label for="tipo_movimiento">Tipo Movimiento:</label>
            <input type="text" id="tipo_movimiento" name="tipo_movimiento" class="form-control" value="<?php echo htmlspecialchars($row['tipo_movimiento']); ?>" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto:</label>
            <input type="number" step="0.01" id="monto" name="monto" class="form-control" value="<?php echo htmlspecialchars($row['monto']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_movimiento">Fecha Movimiento:</label>
            <input type="date" id="fecha_movimiento" name="fecha_movimiento" class="form-control" value="<?php echo htmlspecialchars($row['fecha_movimiento']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_ticket">ID Ticket:</label>
            <input type="number" id="id_ticket" name="id_ticket" class="form-control" value="<?php echo htmlspecialchars($row['id_ticket']); ?>">
        </div>
        <div class="form-group">
            <label for="id_recibo">ID Recibo:</label>
            <input type="number" id="id_recibo" name="id_recibo" class="form-control" value="<?php echo htmlspecialchars($row['id_recibo']); ?>">
        </div>
        <div class="form-group">
            <label for="id_factura">ID Factura:</label>
            <input type="number" id="id_factura" name="id_factura" class="form-control" value="<?php echo htmlspecialchars($row['id_factura']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
