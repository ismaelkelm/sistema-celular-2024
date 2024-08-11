<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];
    $fecha_movimiento = $_POST['fecha_movimiento'];
    $id_documento = $_POST['id_documento'];
    $tipo_documento = $_POST['tipo_documento'];

    $query = "INSERT INTO caja (tipo_movimiento, monto, descripcion, fecha_movimiento, id_documento, tipo_documento) 
              VALUES ('$tipo_movimiento', '$monto', '$descripcion', '$fecha_movimiento', '$id_documento', '$tipo_documento')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Movimiento de Caja</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="tipo_movimiento">Tipo Movimiento:</label>
            <input type="text" id="tipo_movimiento" name="tipo_movimiento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto:</label>
            <input type="number" id="monto" name="monto" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_movimiento">Fecha Movimiento:</label>
            <input type="date" id="fecha_movimiento" name="fecha_movimiento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_documento">ID Documento:</label>
            <input type="text" id="id_documento" name="id_documento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tipo_documento">Tipo Documento:</label>
            <input type="text" id="tipo_documento" name="tipo_documento" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
