<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

// Obtener el ID del detalle de factura a editar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Inicializar variables
$id_facturas = $cantidad = $precio_unitario = "";

// Consultar el detalle de factura a editar
if ($id) {
    $query = "SELECT * FROM detalle_facturas WHERE id_detalle_facturas = $id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id_facturas = htmlspecialchars($row['id_facturas']);
        $cantidad = htmlspecialchars($row['cantidad']);
        $precio_unitario = htmlspecialchars($row['precio_unitario']);
    } else {
        die("Detalle de factura no encontrado.");
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_facturas = mysqli_real_escape_string($conn, $_POST['id_facturas']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    $precio_unitario = mysqli_real_escape_string($conn, $_POST['precio_unitario']);

    $query = "UPDATE detalle_facturas SET id_facturas='$id_facturas', cantidad='$cantidad', precio_unitario='$precio_unitario' WHERE id_detalle_facturas=$id";
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
    <h1 class="mb-4">Editar Detalle de Factura</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <div class="form-group">
            <label for="id_facturas">ID Factura</label>
            <input type="text" class="form-control" id="id_facturas" name="id_facturas" value="<?php echo htmlspecialchars($id_facturas); ?>" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($cantidad); ?>" required>
        </div>
        <div class="form-group">
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" value="<?php echo htmlspecialchars($precio_unitario); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
