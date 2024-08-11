<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pagos = mysqli_real_escape_string($conn, $_POST['id_pagos']);
    $fecha_de_emision = mysqli_real_escape_string($conn, $_POST['fecha_de_emision']);
    $monto = mysqli_real_escape_string($conn, $_POST['monto']);

    $query = "INSERT INTO recibos (id_pagos, fecha_de_emision, monto) VALUES ('$id_pagos', '$fecha_de_emision', '$monto')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el recibo: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Recibo</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id_pagos">ID Pago</label>
            <input type="number" class="form-control" id="id_pagos" name="id_pagos" required>
        </div>
        <div class="form-group">
            <label for="fecha_de_emision">Fecha de Emisión</label>
            <input type="date" class="form-control" id="fecha_de_emision" name="fecha_de_emision" required>
        </div>
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
