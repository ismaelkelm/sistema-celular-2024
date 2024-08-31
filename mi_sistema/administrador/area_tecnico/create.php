<?php
include '../../base_datos/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];

    $query = "INSERT INTO area_tecnico (nombre) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nombre);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        die("Error en la inserción: " . $conn->error);
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Área Técnica</h1>
    <form action="create.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
mysqli_close($conn);
?>
