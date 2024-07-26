<?php
session_start();

// Definir la sección actual
$section = 'administrativo';

// Definir los íconos y las rutas en función de la sección
$sections = [
    'administrativo' => [
        ['icon' => 'fa-box', 'label' => 'Accesorios', 'path' => 'accesorios/index.php'],
        ['icon' => 'fa-users', 'label' => 'Clientes', 'path' => 'clientes/index.php'],
        ['icon' => 'fa-file-invoice', 'label' => 'Detalle Facturas', 'path' => 'detalle_facturas/index.php'],
        ['icon' => 'fa-tools', 'label' => 'Detalle Reparaciones', 'path' => 'detalle_reparaciones/index.php'],
        // Agrega más elementos según sea necesario
    ]
];

// Verifica si la sección actual existe en el array de secciones
$icons = isset($sections[$section]) ? $sections[$section] : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrativo - Mi Empresa</title>
    <!-- Enlazar el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlazar Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tu archivo CSS personalizado -->
    <link rel="stylesheet" href="../estilos/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/nav.php'; ?>

    <div class="container my-4">
        <h2>Panel Administrativo</h2>
        <p>Contenido específico para el área administrativa.</p>
        
        <!-- Menú principal con íconos -->
        <div class="row">
            <?php
            // Mostrar los íconos y enlaces
            foreach ($icons as $icon) {
                echo '<div class="col-md-2 text-center mb-4">';
                echo '<a href="' . $icon['path'] . '" class="btn btn-light p-3 d-block">';
                echo '<i class="fas ' . $icon['icon'] . ' fa-2x"></i>';
                echo '<p class="mt-2">' . $icon['label'] . '</p>';
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
    <script src="script/nav.js/script.js"></script>
</body>
</html>
