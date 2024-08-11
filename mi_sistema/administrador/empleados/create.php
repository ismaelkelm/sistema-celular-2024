<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $id_usuarios = $_POST['id_usuarios'];

    $query = "INSERT INTO empleados (nombre, cargo, id_usuarios) 
              VALUES ('$nombre', '$cargo', '$id_usuarios')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Empleado</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_usuarios">ID Usuario:</label>
            <input type="number" id="id_usuarios" name="id_usuarios" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
