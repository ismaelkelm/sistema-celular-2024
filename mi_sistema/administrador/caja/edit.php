<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_caja = $_POST['id_caja'];
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $fecha_movimiento = $_POST['fecha_movimiento'];
    $id_documento = $_POST['id_documento'];
    $tipo_documento = $_POST['tipo_documento'];

    $query = "UPDATE caja SET tipo_movimiento='$tipo_movimiento', monto='$monto', descripcion='$descripcion', fecha_movimiento='$fecha_movimiento', id_documento='$id_documento', tipo_documento='$tipo_documento' WHERE id_caja=$id_caja";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    $id_caja = $_GET['id'];
    $query = "SELECT * FROM caja WHERE id_caja=$id_caja";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Movimiento de Caja</h1>
    <form method="post" action="">
        <input type="hidden" name="id_caja" value="<?php echo htmlspecialchars($row['id_caja']); ?>">
        <div class="form-group">
            <label for="tipo_movimiento">Tipo Movimiento:</label>
            <input type="text" id="tipo_movimiento" name="tipo_movimiento" class="form-control" value="<?php echo htmlspecialchars($row['tipo_movimiento']); ?>" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto:</label>
            <input type="number" id="monto" name="monto" class="form-control" step="0.01" value="<?php echo htmlspecialchars($row['monto']); ?>" required>
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
            <label for="id_documento">ID Documento:</label>
            <input type="text" id="id_documento" name="id_documento" class="form-control" value="<?php echo htmlspecialchars($row['id_documento']); ?>" required>
        </div>
        <div class="form-group">
            <label for="tipo_documento">Tipo Documento:</label>
            <input type="text" id="tipo_documento" name="tipo_documento" class="form-control" value="<?php echo htmlspecialchars($row['tipo_documento']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
