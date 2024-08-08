<?php
<<<<<<< HEAD
// Incluir los archivos necesarios
=======
echo "cliente";
session_start();

// Incluir el archivo de conexión
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc
require_once '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples
require_once '../base_datos/roles.php'; // Usar require_once para evitar inclusiones múltiples
require_once '../base_datos/functions.php'; // Incluir funciones para obtener iconos

// Obtener los permisos del rol del usuario
$rolePermissions = include('../base_datos/roles.php');
$userRole = 'Cliente'; // Ejemplo de rol; en una aplicación real, esto se obtendría del login o sesión
$permissions = $rolePermissions[$userRole] ?? [];

$pageTitle = "Cliente - Mi Empresa"; // Establecer el título específico para esta página
include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome para iconos -->
    <style>
        /* Estilo general */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        #content-container {
            background-color: skyblue;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
        }

        /* Estilo para los iconos */
        .icon-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .icon-item {
            background-color: #ffffff;
            border-radius: 8px;
            margin: 1rem;
            padding: 1rem;
            width: 150px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
        }

        .icon-item:hover {
            background-color: yellowgreen;
            color: #ffffff;
            transform: scale(1.05);
        }

        .icon-item i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .icon-item p {
            margin: 0;
            font-size: 1rem;
        }

        /* Estilo para el footer */
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 1rem 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div id="content-container" class="container my-4">
        <h2 class="text-center">Panel de Cliente</h2>
        
        <!-- Enlace para consultar estado de reparación -->
        <ul class="list-unstyled">
            <li>
                <a href="../cliente/check_status.php" class="btn btn-primary">Consultar Estado de Reparación</a>
            </li>
        </ul>

        <!-- Sección de iconos -->
        <div class="icon-grid">
            <?php foreach ($permissions as $permission => $status): ?>
                <div class="icon-item">
                    <i class="fas fa-<?php echo getIconClass($permission); ?>"></i>
                    <p><?php echo htmlspecialchars($permission); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
