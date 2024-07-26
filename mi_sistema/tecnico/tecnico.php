<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Técnico - Mi Empresa</title>
    <!-- Enlazar el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlazar Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tu archivo CSS personalizado -->
    <link rel="stylesheet" href="../estilos/styles.css">  <!-- Ajusta la ruta si es necesario -->
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/nav.php'; ?>

    <div class="container my-4">
        <h2>Panel del Técnico</h2>
        <p>Contenido específico para el técnico.</p>
        
        <!-- Menú principal con íconos -->
        <div class="row">
            <?php
            // Definir los íconos y las rutas para el técnico
            $icons = [
                ['icon' => 'fa-tools', 'label' => 'Reparaciones', 'path' => 'reparaciones/index.php'],
                ['icon' => 'fa-box-open', 'label' => 'Pedidos de Reparación', 'path' => 'pedidos_de_reparacion/index.php'],
                ['icon' => 'fa-cogs', 'label' => 'Piezas y Componentes', 'path' => 'piezas_y_componentes/index.php'],
                ['icon' => 'fa-users', 'label' => 'Clientes', 'path' => 'clientes/index.php'],
                ['icon' => 'fa-file-invoice', 'label' => 'Facturas', 'path' => 'facturas/index.php'],
                ['icon' => 'fa-receipt', 'label' => 'Recibos', 'path' => 'recibos/index.php'],
                ['icon' => 'fa-bell', 'label' => 'Notificaciones', 'path' => 'notificaciones/index.php']
            ];

            // Mostrar los íconos y enlaces
            foreach ($icons as $icon) {
                echo '<div class="col-md-2 text-center mb-4">';
                echo '<a href="' . htmlspecialchars($icon['path']) . '" class="btn btn-light p-3 d-block">';
                echo '<i class="fas ' . htmlspecialchars($icon['icon']) . ' fa-2x"></i>';
                echo '<p class="mt-2">' . htmlspecialchars($icon['label']) . '</p>';
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <!-- Enlazar los archivos JS de Bootstrap y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Enlazar el archivo JS personalizado si es necesario -->
    <script src="../js/script.js"></script>
</body>
</html>
