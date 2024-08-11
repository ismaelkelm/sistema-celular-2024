<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reparacion = $_POST['id_reparacion'];
    $id_piezas_y_componentes = $_POST['id_piezas_y_componentes'];
    $cantidad_usada = $_POST['cantidad_usada'];

    $query = "INSERT INTO detalle_reparaciones (id_reparacion, id_piezas_y_componentes, cantidad_usada) 
              VALUES ('$id_reparacion', '$id_piezas_y_componentes', '$cantidad_usada')";

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

    <h1 class="mb-4">Agregar Detalle de Reparación</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_reparacion">ID Reparación:</label>
            <input type="number" id="id_reparacion" name="id_reparacion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_piezas_y_componentes">ID Pieza/Componente:</label>
            <input type="number" id="id_piezas_y_componentes" name="id_piezas_y_componentes" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cantidad_usada">Cantidad Usada:</label>
            <input type="number" id="cantidad_usada" name="cantidad_usada" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
