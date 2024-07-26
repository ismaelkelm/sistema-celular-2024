<?php
session_start();
$permissionsConfig = include('../base_datos/admin.php');

// Supongamos que el rol del usuario está almacenado en la sesión
$role = $_SESSION['role'];
$permissions = $permissionsConfig[$role] ?? [];

// Determina qué permisos tiene el usuario
function hasPermission($permission) {
    global $permissions;
    return !empty($permissions[$permission]);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../estilos/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/nav.php'; ?>

    <div class="container my-4">
        <h2>Panel de Control</h2>
        <div class="row">
            <?php if (hasPermission('Clientes')): ?>
                <div class="col-md-2 text-center mb-4">
                    <a href="clientes/" class="btn btn-light p-3 d-block">
                        <i class="fas fa-users fa-2x"></i>
                        <p class="mt-2">Clientes</p>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (hasPermission('Pedidos de Reparación')): ?>
                <div class="col-md-2 text-center mb-4">
                    <a href="pedidos_de_reparacion/" class="btn btn-light p-3 d-block">
                        <i class="fas fa-box-open fa-2x"></i>
                        <p class="mt-2">Pedidos de Reparación</p>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (hasPermission('Reparaciones')): ?>
                <div class="col-md-2 text-center mb-4">
                    <a href="reparaciones/" class="btn btn-light p-3 d-block">
                        <i class="fas fa-wrench fa-2x"></i>
                        <p class="mt-2">Reparaciones</p>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (hasPermission('Notificaciones')): ?>
                <div class="col-md-2 text-center mb-4">
                    <a href="notificaciones/" class="btn btn-light p-3 d-block">
                        <i class="fas fa-bell fa-2x"></i>
                        <p class="mt-2">Notificaciones</p>
                    </a>
                </div>
            <?php endif; ?>
            <!-- No mostrar secciones de dinero -->
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
