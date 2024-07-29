<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $correo_electronico = mysqli_real_escape_string($conn, $_POST['correo_electronico']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $numero_pedido = mysqli_real_escape_string($conn, $_POST['numero_pedido']);

    $query = "INSERT INTO clientes (nombre, telefono, correo_electronico, direccion, numero_pedido) VALUES ('$nombre', '$telefono', '$correo_electronico', '$direccion', '$numero_pedido')";
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
    <h1 class="mb-4">Agregar Cliente</h1>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="form-group">
            <label for="numero_pedido">Número de Pedido</label>
            <input type="text" class="form-control" id="numero_pedido" name="numero_pedido">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
