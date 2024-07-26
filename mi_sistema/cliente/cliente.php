<?php
// Incluye el archivo functions.php desde la carpeta base_datos
include_once '../base_datos/functions.php'; // Ajusta la ruta según tu estructura de directorios
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Estado</title>
    <!-- Enlazar el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tu archivo CSS personalizado -->
    <link rel="stylesheet" href="../estilos/styles.css"> <!-- Ajusta la ruta para acceder a styles.css -->
</head>
<body>
    <div class="container my-4">
        <h2>Consulta de Estado de Reparación</h2>
        <form id="status-form" method="post" action="">
            <div class="form-group">
                <label for="order-number">Número de Orden:</label>
                <input type="text" class="form-control" id="order-number" name="order-number" placeholder="Ingrese su número de orden" required>
            </div>
            <button type="submit" class="btn btn-primary">Consultar Estado</button>
            <a href="../index.php" class="btn btn-secondary mt-3">Volver</a>
        </form>
        
        <div id="status-result" class="mt-4">
            <?php
            // Lógica para manejar la consulta de estado
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['order-number'])) {
                $orderNumber = $_POST['order-number'];
                $status = getOrderStatus($orderNumber);
                echo "<div class='alert {$status['class']}'>{$status['text']}</div>";
            }
            ?>
        </div>
    </div>

    <!-- Enlazar los archivos JS de Bootstrap y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
