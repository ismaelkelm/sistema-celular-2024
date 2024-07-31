<?php
include_once '../base_datos/db.php';
include_once '../base_datos/functions.php'; // Asegúrate de que la ruta es correcta

// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Obtener el número de orden desde el formulario
$order_number = isset($_POST['order_number']) ? htmlspecialchars(trim($_POST['order_number'])) : '';
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
            font-size: 1.5em; /* Tamaño de letra más grande */
            color: #28a745; /* Verde para completado */
            font-weight: bold; /* Negrita */
        }
        .status-pendiente {
            font-size: 1.2em;
            color: #ffc107; /* Amarillo para pendiente */
            font-weight: bold;
        }
        .status-cancelado {
            font-size: 1.2em;
            color: #dc3545; /* Rojo para cancelado */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Consulta de Estado</h2>
        
        <?php
        if (!empty($order_number)) {
            // Función para obtener el estado de la orden
            $status = getOrderStatus($order_number);

            // Definir el mensaje y la clase CSS para el estado
            $status_message = '';
            $status_class = '';

            if ($status !== null) {
                switch ($status) {
                    case 'Pendiente':
                        $status_message = "El estado de la orden <strong>{$order_number}</strong> es: <strong class='status-pendiente'>{$status}</strong>";
                        break;
                    case 'Completado':
                        $status_message = "El estado de la orden <strong>{$order_number}</strong> es: <strong class='status-completado'>{$status}</strong>";
                        break;
                    case 'Cancelado':
                        $status_message = "El estado de la orden <strong>{$order_number}</strong> es: <strong class='status-cancelado'>{$status}</strong>";
                        break;
                    default:
                        $status_message = "El estado de la orden <strong>{$order_number}</strong> es: <strong>{$status}</strong>";
                        break;
                }
                echo "<div class='alert alert-info'>{$status_message}</div>";
            } else {
                echo "<div class='alert alert-warning'>No se encontró ninguna orden con el número <strong>{$order_number}</strong>.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Por favor ingrese un número de orden.</div>";
        }
        ?>

        <div class="mt-4">
            <a href="cliente.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
