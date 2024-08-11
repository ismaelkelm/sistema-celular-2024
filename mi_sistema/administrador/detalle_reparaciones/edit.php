<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_detalle_reparaciones = $_POST['id_detalle_reparaciones'];
    $id_reparacion = $_POST['id_reparacion'];
    $id_piezas_y_componentes = $_POST['id_piezas_y_componentes'];
    $cantidad_usada = $_POST['cantidad_usada'];

    $query = "UPDATE detalle_reparaciones SET id_reparacion='$id_reparacion', id_piezas_y_componentes='$id_piezas_y_componentes', cantidad_usada='$cantidad_usada' WHERE id_detalle_reparaciones=$id_detalle_reparaciones";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    $id_detalle_reparaciones = $_GET['id'];
    $query = "SELECT * FROM detalle_reparaciones WHERE id_detalle_reparaciones=$id_detalle_reparaciones";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Detalle de Reparación</h1>
    <form method="post" action="">
        <input type="hidden" name="id_detalle_reparaciones" value="<?php echo htmlspecialchars($row['id_detalle_reparaciones']); ?>">
        <div class="form-group">
            <label for="id_reparacion">ID Reparación:</label>
            <input type="number" id="id_reparacion" name="id_reparacion" class="form-control" value="<?php echo htmlspecialchars($row['id_reparacion']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_piezas_y_componentes">ID Pieza/Componente:</label>
            <input type="number" id="id_piezas_y_componentes" name="id_piezas_y_componentes" class="form-control" value="<?php echo htmlspecialchars($row['id_piezas_y_componentes']); ?>" required>
        </div>
        <div class="form-group">
            <label for="cantidad_usada">Cantidad Usada:</label>
            <input type="number" id="cantidad_usada" name="cantidad_usada" class="form-control" value="<?php echo htmlspecialchars($row['cantidad_usada']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
