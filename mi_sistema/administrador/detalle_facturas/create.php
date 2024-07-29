<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar los IDs de facturas disponibles
$query_facturas = "SELECT id_facturas FROM facturas";
$result_facturas = mysqli_query($conn, $query_facturas);

// Verificar si la consulta fue exitosa
if (!$result_facturas) {
    die("Error en la consulta de facturas: " . mysqli_error($conn));
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $id_facturas = mysqli_real_escape_string($conn, $_POST['id_facturas']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    $precio_unitario = mysqli_real_escape_string($conn, $_POST['precio_unitario']);

    // Preparar la consulta SQL para insertar el nuevo detalle de factura
    $query = "INSERT INTO detalle_facturas (id_facturas, cantidad, precio_unitario) VALUES ('$id_facturas', '$cantidad', '$precio_unitario')";

    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($conn, $query)) {
        header("Location: index.php"); // Redirigir a la página principal de la lista
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Mostrar mensaje de error
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Detalle de Factura</h1>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="id_facturas">ID Factura</label>
            <select class="form-control" id="id_facturas" name="id_facturas" required>
                <?php while ($row = mysqli_fetch_assoc($result_facturas)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id_facturas']); ?>">
                        <?php echo htmlspecialchars($row['id_facturas']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="form-group">
            <label for="precio_unitario">Precio Unitario</label>
            <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
