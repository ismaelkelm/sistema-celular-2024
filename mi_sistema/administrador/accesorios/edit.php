<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

// Obtener el ID del accesorio a editar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Inicializar variables
$nombre = $descripcion = $precio = $stock = "";

// Consultar el accesorio a editar
if ($id) {
    $query = "SELECT * FROM accesorios WHERE id_accesorios = $id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre = htmlspecialchars($row['nombre']);
        $descripcion = htmlspecialchars($row['descripción']);
        $precio = htmlspecialchars($row['precio']);
        $stock = htmlspecialchars($row['stock']);
    } else {
        die("Accesorio no encontrado.");
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    $query = "UPDATE accesorios SET nombre='$nombre', descripción='$descripcion', precio='$precio', stock='$stock' WHERE id_accesorios=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Accesorio</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($descripcion); ?></textarea>
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($precio); ?>" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($stock); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
