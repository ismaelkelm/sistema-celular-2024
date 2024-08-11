<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $id_pagos = mysqli_real_escape_string($conn, $_POST['id_pagos']);
    $fecha_de_emision = mysqli_real_escape_string($conn, $_POST['fecha_de_emision']);
    $monto = mysqli_real_escape_string($conn, $_POST['monto']);

    $query = "UPDATE recibos SET id_pagos='$id_pagos', fecha_de_emision='$fecha_de_emision', monto='$monto' WHERE id_recibos='$id'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el recibo: " . mysqli_error($conn));
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM recibos WHERE id_recibos='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Recibo</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_recibos']); ?>">
        <div class="form-group">
            <label for="id_pagos">ID Pago</label>
            <input type="number" class="form-control" id="id_pagos" name="id_pagos" value="<?php echo htmlspecialchars($row['id_pagos']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_emision">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_de_emision" name="fecha_de_emision" value="<?php echo htmlspecialchars($row['fecha_de_emision']); ?>" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="<?php echo htmlspecialchars($row['monto']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
