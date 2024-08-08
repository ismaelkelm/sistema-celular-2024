<?php
include_once '../base_datos/db.php';
include_once '../base_datos/functions.php';

// Obtener los datos del formulario
$order_number = isset($_POST['order_number']) ? htmlspecialchars(trim($_POST['order_number'])) : '';
$customer_name = isset($_POST['customer_name']) ? htmlspecialchars(trim($_POST['customer_name'])) : '';
$customer_phone = isset($_POST['customer_phone']) ? htmlspecialchars(trim($_POST['customer_phone'])) : '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Estado - Mi Empresa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-completado {
            font-size: 1.5em;
            color: #28a745;
            font-weight: bold;
        }
        .status-pendiente {
            font-size: 1.2em;
            color: #ffc107;
            font-weight: bold;
        }
        .status-cancelado {
            font-size: 1.2em;
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Consulta de Estado</h2>
        
        <!-- Formulario para ingresar los datos -->
        <form action="check_status.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="order_number">Número de Orden:</label>
                <input type="text" id="order_number" name="order_number" class="form-control" placeholder="Ingrese el número de orden" value="<?php echo htmlspecialchars($order_number); ?>" required>
            </div>
            <div class="form-group">
                <label for="customer_name">Nombre del Cliente:</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Ingrese el nombre del cliente" value="<?php echo htmlspecialchars($customer_name); ?>">
            </div>
            <div class="form-group">
                <label for="customer_phone">Teléfono del Cliente:</label>
                <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Ingrese el teléfono del cliente" value="<?php echo htmlspecialchars($customer_phone); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>
        
        <?php
        if (!empty($order_number) && !empty($customer_name) && !empty($customer_phone)) {
            // Función para obtener el estado de la orden si los datos coinciden
            $order_info = getOrderStatus($order_number, $customer_name, $customer_phone);

            // Definir el mensaje y la clase CSS para el estado
            $status_message = '';
            $status_class = '';

            if ($order_info !== null) {
                $estado = $order_info['estado'];
                $nombre = htmlspecialchars($order_info['nombre']);
                $telefono = htmlspecialchars($order_info['telefono']);

                switch ($estado) {
                    case 'Pendiente':
                        $status_message = "<strong>Estado:</strong> <span class='status-pendiente'>{$estado}</span>";
                        break;
                    case 'Completado':
                        $status_message = "<strong>Estado:</strong> <span class='status-completado'>{$estado}</span>";
                        break;
                    case 'Cancelado':
                        $status_message = "<strong>Estado:</strong> <span class='status-cancelado'>{$estado}</span>";
                        break;
                    default:
                        $status_message = "<strong>Estado:</strong> <span>{$estado}</span>";
                        break;
                }
                echo "<div class='alert alert-info'>";
                echo "<p><strong>Número de Orden:</strong> {$order_number}</p>";
                echo "<p><strong>Nombre del Cliente:</strong> {$nombre}</p>";
                echo "<p><strong>Teléfono del Cliente:</strong> {$telefono}</p>";
                echo "<p>{$status_message}</p>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning'>No se encontró ninguna información con los datos proporcionados.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Por favor, complete todos los campos.</div>";
        }
        ?>

        <div class="mt-4">
            <a href="../cliente/cliente.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
