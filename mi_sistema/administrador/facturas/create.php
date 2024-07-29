<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $id_proveedores = mysqli_real_escape_string($conn, $_POST['id_proveedores']);
    $fecha_de_emision = mysqli_real_escape_string($conn, $_POST['fecha_de_emision']);
    $subtotal = mysqli_real_escape_string($conn, $_POST['subtotal']);
    $impuestos = mysqli_real_escape_string($conn, $_POST['impuestos']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);

    // Verificar si el id_proveedores existe en la tabla proveedores
    $proveedor_query = "SELECT id_proveedores FROM proveedores WHERE id_proveedores = '$id_proveedores'";
    $proveedor_result = mysqli_query($conn, $proveedor_query);

    // Verificar si se obtuvo algún resultado
    if (mysqli_num_rows($proveedor_result) == 0) {
        die("Error: El ID de proveedor no existe en la base de datos.");
    }

    // Preparar la consulta SQL para insertar una nueva factura
    $query = "INSERT INTO facturas (id_proveedores, fecha_de_emision, subtotal, impuestos, total) 
              VALUES ('$id_proveedores', '$fecha_de_emision', '$subtotal', '$impuestos', '$total')";

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
    <h1 class="mb-4">Agregar Factura</h1>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="id_proveedores">ID Proveedor</label>
            <input type="number" class="form-control" id="id_proveedores" name="id_proveedores" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_emision">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_de_emision" name="fecha_de_emision" required>
        </div>
        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" required>
        </div>
        <div class="form-group">
            <label for="impuestos">Impuestos</label>
            <input type="number" step="0.01" class="form-control" id="impuestos" name="impuestos" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" class="form-control" id="total" name="total" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
