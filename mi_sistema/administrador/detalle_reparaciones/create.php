<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $id_reparacion = mysqli_real_escape_string($conn, $_POST['id_reparacion']);
    $id_pieza = mysqli_real_escape_string($conn, $_POST['id_pieza']);
    $cantidad_usada = mysqli_real_escape_string($conn, $_POST['cantidad_usada']);

    // Preparar la consulta SQL para insertar el nuevo detalle de reparación
    $query = "INSERT INTO detalle_reparaciones (id_reparacion, id_pieza, cantidad_usada) VALUES ('$id_reparacion', '$id_pieza', '$cantidad_usada')";

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
    <h1 class="mb-4">Agregar Detalle de Reparación</h1>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="id_reparacion">ID Reparación</label>
            <input type="number" class="form-control" id="id_reparacion" name="id_reparacion" required>
        </div>
        <div class="form-group">
            <label for="id_pieza">ID Pieza</label>
            <input type="number" class="form-control" id="id_pieza" name="id_pieza" required>
        </div>
        <div class="form-group">
            <label for="cantidad_usada">Cantidad Usada</label>
            <input type="number" class="form-control" id="cantidad_usada" name="cantidad_usada" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
