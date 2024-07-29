<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);

    // Preparar la consulta SQL para insertar un nuevo empleado
    $query = "INSERT INTO empleados (nombre, cargo) VALUES ('$nombre', '$cargo')";

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
    <h1 class="mb-4">Agregar Empleado</h1>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
