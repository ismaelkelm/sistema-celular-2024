<?php
<<<<<<< HEAD
// Incluir los archivos necesarios
require_once '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples
require_once '../base_datos/roles.php'; // Usar require_once para evitar inclusiones múltiples
require_once '../base_datos/functions.php'; // Incluir funciones para obtener iconos

// Obtener los permisos del rol del usuario
$rolePermissions = include('../base_datos/roles.php');
$userRole = 'Tecnico'; // Ejemplo de rol; en una aplicación real, esto se obtendría del login o sesión
$permissions = $rolePermissions[$userRole] ?? [];

$pageTitle = "Técnico - Mi Empresa"; // Establecer el título específico para esta página
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
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        #content-container {
            background-color: skyblue;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            max-width: 100%;
            width: 90%;
        }

        /* Título */
        h2 {
            color: #333333;
            font-weight: 300;
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        .icon-item:hover {
            background-color: green;
            color: #ffffff;
            transform: scale(1.05);
            cursor: pointer;
        }

        .icon-item i {
            font-size: 1.5rem; /* Reducido para mantener consistencia */
            margin-bottom: 0.75rem;
        }

        .icon-item p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Estilo para el footer */
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            #content-container {
                padding: 1rem;
                margin: 1rem auto;
                width: 95%;
            }

            .icon-item {
                width: 120px;
            }

            .icon-item i {
                font-size: 1.25rem;
            }

            .icon-item p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div id="content-container" class="container-fluid">
        <h2 class="text-center">Panel de Técnico</h2>

        <!-- Sección de iconos -->
        <div class="icon-grid">
            <?php foreach ($permissions as $permission => $status): ?>
                <?php if ($status === 'on'): ?>
                    <div class="icon-item">
                        <i class="fas fa-<?php echo getIconClass($permission); ?>"></i>
                        <p><?php echo htmlspecialchars($permission); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Incluir el footer -->
    <?php include('../includes/footer.php'); ?>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
=======
echo "Tecnicoooo";
session_start();

// Incluir el archivo de conexión
require '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
                <li class="nav-item">
                    <a href="../login/logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
</body>
</html>
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc
