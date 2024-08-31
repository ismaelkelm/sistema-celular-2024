<?php
include '../../base_datos/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];

    $query = "UPDATE area_tecnico SET nombre = ? WHERE id_area_tecnico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $nombre, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        die("Error en la actualización: " . $conn->error);
    }
} else {
    $query = "SELECT * FROM area_tecnico WHERE id_area_tecnico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Área Técnica</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
mysqli_close($conn);
?>
