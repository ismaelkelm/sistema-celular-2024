<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Verificar si se ha enviado un ID de empleado
if (isset($_GET['id'])) {
    $id_empleados = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Obtener los datos actuales del empleado
    $query = "SELECT * FROM empleados WHERE id_empleados = $id_empleados";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    $empleado = mysqli_fetch_assoc($result);

    if (!$empleado) {
        die("Empleado no encontrado.");
    }
} else {
    die("ID de empleado no especificado.");
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
    
    // Preparar la consulta SQL para actualizar el empleado
    $query = "UPDATE empleados SET nombre='$nombre', cargo='$cargo' WHERE id_empleados=$id_empleados";

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
    <h1 class="mb-4">Editar Empleado</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($id_empleados); ?>" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo htmlspecialchars($empleado['cargo']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
