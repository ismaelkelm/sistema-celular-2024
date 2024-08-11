<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Obtener el ID del dispositivo a editar
$id = $_GET['id'];

// Consultar el dispositivo específico
$query = "SELECT * FROM dispositivos WHERE id_dispositivos = '$id'";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// Obtener los datos del dispositivo
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Dispositivo no encontrado");
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $marca = mysqli_real_escape_string($conn, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $numero_de_serie = mysqli_real_escape_string($conn, $_POST['numero_de_serie']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);

    // Preparar la consulta SQL para actualizar el dispositivo
    $query = "UPDATE dispositivos SET marca='$marca', modelo='$modelo', numero_de_serie='$numero_de_serie', estado='$estado' WHERE id_dispositivos='$id'";

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
    <h1 class="mb-4">Editar Dispositivo</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($row['id_dispositivos']); ?>" method="post">
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($row['marca']); ?>" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo htmlspecialchars($row['modelo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="numero_de_serie">Número de Serie</label>
            <input type="text" class="form-control" id="numero_de_serie" name="numero_de_serie" value="<?php echo htmlspecialchars($row['numero_de_serie']); ?>" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?php echo htmlspecialchars($row['estado']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
