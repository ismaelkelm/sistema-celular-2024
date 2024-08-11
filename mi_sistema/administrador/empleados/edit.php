<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_empleados = $_POST['id_empleados'];
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $id_usuarios = $_POST['id_usuarios'];

    $query = "UPDATE empleados SET nombre='$nombre', cargo='$cargo', id_usuarios='$id_usuarios' WHERE id_empleados=$id_empleados";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    $id_empleados = $_GET['id'];
    $query = "SELECT * FROM empleados WHERE id_empleados=$id_empleados";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Empleado</h1>
    <form method="post" action="">
        <input type="hidden" name="id_empleados" value="<?php echo htmlspecialchars($row['id_empleados']); ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" class="form-control" value="<?php echo htmlspecialchars($row['cargo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_usuarios">ID Usuario:</label>
            <input type="number" id="id_usuarios" name="id_usuarios" class="form-control" value="<?php echo htmlspecialchars($row['id_usuarios']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
