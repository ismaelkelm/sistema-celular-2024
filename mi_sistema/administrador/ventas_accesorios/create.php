<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_clientes = mysqli_real_escape_string($conn, $_POST['id_clientes']);
    $id_accesorios = mysqli_real_escape_string($conn, $_POST['id_accesorios']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    $precio_total = mysqli_real_escape_string($conn, $_POST['precio_total']);
    $fecha_venta = mysqli_real_escape_string($conn, $_POST['fecha_venta']);

    $query = "INSERT INTO ventas_accesorios (id_clientes, id_accesorios, cantidad, precio_total, fecha_venta) VALUES ('$id_clientes', '$id_accesorios', '$cantidad', '$precio_total', '$fecha_venta')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar la venta: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Venta</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_clientes">Cliente</label>
            <select class="form-control" id="id_clientes" name="id_clientes" required>
                <?php
                $clientesQuery = "SELECT * FROM clientes";
                $clientesResult = mysqli_query($conn, $clientesQuery);
                while ($cliente = mysqli_fetch_assoc($clientesResult)) {
                    echo "<option value='" . htmlspecialchars($cliente['id_clientes']) . "'>" . htmlspecialchars($cliente['nombre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_accesorios">Accesorio</label>
            <select class="form-control" id="id_accesorios" name="id_accesorios" required>
                <?php
                $accesoriosQuery = "SELECT * FROM accesorios";
                $accesoriosResult = mysqli_query($conn, $accesoriosQuery);
                while ($accesorio = mysqli_fetch_assoc($accesoriosResult)) {
                    echo "<option value='" . htmlspecialchars($accesorio['id_accesorios']) . "'>" . htmlspecialchars($accesorio['nombre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <div class="form-group">
            <label for="precio_total">Precio Total</label>
            <input type="number" step="0.01" class="form-control" id="precio_total" name="precio_total" required>
        </div>
        <div class="form-group">
            <label for="fecha_venta">Fecha de Venta</label>
            <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
