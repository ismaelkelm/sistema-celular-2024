<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);

    $query = "UPDATE piezas_y_componentes SET nombre='$nombre', descripcion='$descripcion', stock='$stock', precio='$precio' WHERE id_piezas_y_componentes='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar la pieza: " . mysqli_error($conn));
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM piezas_y_componentes WHERE id_piezas_y_componentes='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Pieza</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_piezas_y_componentes']); ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($row['stock']); ?>" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
