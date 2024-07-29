<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php';

// Obtener el ID del cliente a editar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Inicializar variables
$nombre = $telefono = $correo_electronico = $direccion = $numero_pedido = "";

// Consultar el cliente a editar
if ($id) {
    $query = "SELECT * FROM clientes WHERE id_clientes = $id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre = htmlspecialchars($row['nombre']);
        $telefono = htmlspecialchars($row['telefono']);
        $correo_electronico = htmlspecialchars($row['correo_electronico']);
        $direccion = htmlspecialchars($row['direccion']);
        $numero_pedido = htmlspecialchars($row['numero_pedido']);
    } else {
        die("Cliente no encontrado.");
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $correo_electronico = mysqli_real_escape_string($conn, $_POST['correo_electronico']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $numero_pedido = mysqli_real_escape_string($conn, $_POST['numero_pedido']);

    $query = "UPDATE clientes SET nombre='$nombre', telefono='$telefono', correo_electronico='$correo_electronico', direccion='$direccion', numero_pedido='$numero_pedido' WHERE id_clientes=$id";
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
    <h1 class="mb-4">Editar Cliente</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo htmlspecialchars($correo_electronico); ?>" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required>
        </div>
        <div class="form-group">
            <label for="numero_pedido">Número de Pedido</label>
            <input type="text" class="form-control" id="numero_pedido" name="numero_pedido" value="<?php echo htmlspecialchars($numero_pedido); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
