<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pagos = mysqli_real_escape_string($conn, $_POST['id_pagos']);
    $id_recibo = mysqli_real_escape_string($conn, $_POST['id_recibo']);
    $monto = mysqli_real_escape_string($conn, $_POST['monto']);
    $fecha_pago = mysqli_real_escape_string($conn, $_POST['fecha_pago']);

    $query = "UPDATE pagos 
              SET id_recibo='$id_recibo', monto='$monto', fecha_pago='$fecha_pago'
              WHERE id_pagos='$id_pagos'";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al actualizar el pago: " . mysqli_error($conn));
    }
} else {
    $id_pagos = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM pagos WHERE id_pagos='$id_pagos'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Editar Pago</h1>
    <form method="POST">
        <input type="hidden" name="id_pagos" value="<?php echo htmlspecialchars($row['id_pagos']); ?>">
        <div class="form-group">
            <label for="id_recibo">ID Recibo</label>
            <input type="number" class="form-control" id="id_recibo" name="id_recibo" value="<?php echo htmlspecialchars($row['id_recibo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" class="form-control" id="monto" name="monto" step="0.01" value="<?php echo htmlspecialchars($row['monto']); ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_pago">Fecha de Pago</label>
            <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" value="<?php echo htmlspecialchars($row['fecha_pago']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
