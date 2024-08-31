<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login/login.php");  // Ajusta la ruta aquí
    exit;
}

// Obtener el rol del usuario (esto debería estar definido en tu sesión o base de datos)
$rol = $_SESSION['rol'];

// Cargar permisos
$permisos = include('permisos.php');
$permisos_usuario = $permisos[$rol];

// Función para verificar permisos
function tienePermiso($modulo, $permisos) {
    return isset($permisos[$modulo]) && $permisos[$modulo] === 'on';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Empresa</title>
    <!-- Enlazar el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlazar Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Enlazar CSS personalizado -->
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>
    <!-- Contenedor del Encabezado -->
    <?php include('includes/header.php'); ?>

    <!-- Contenedor de la Barra de Navegación -->
    <?php include('includes/nav.php'); ?>

    <!-- Contenedor del Contenido Principal -->
    <div id="content-container" class="container my-4">
        <h2 class="text-center">Íconos Disponibles</h2>
        <div class="row">
            <!-- Iconos -->
            <?php if (tienePermiso('Accesorios', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/accesorios/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-box fa-3x"></i>
                    <p class="mt-2">Accesorios</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Clientes', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/clientes/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-users fa-3x"></i>
                    <p class="mt-2">Clientes</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Detalle Facturas', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/detalle_facturas/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-file-invoice fa-3x"></i>
                    <p class="mt-2">Detalle Facturas</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Detalle Reparaciones', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/detalle_reparaciones/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-tools fa-3x"></i>
                    <p class="mt-2">Detalle Reparaciones</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Dispositivos', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/dispositivos/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-mobile-alt fa-3x"></i>
                    <p class="mt-2">Dispositivos</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Empleados', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/empleados/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-user-tie fa-3x"></i>
                    <p class="mt-2">Empleados</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Facturas', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/facturas/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-file-invoice-dollar fa-3x"></i>
                    <p class="mt-2">Facturas</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Notificaciones', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/notificaciones/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-bell fa-3x"></i>
                    <p class="mt-2">Notificaciones</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Pagos', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/pagos/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-money-bill-wave fa-3x"></i>
                    <p class="mt-2">Pagos</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Pedidos de Reparación', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/pedidos_de_reparacion/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-box-open fa-3x"></i>
                    <p class="mt-2">Pedidos de Reparación</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Piezas y Componentes', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/piezas_y_componentes/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-cogs fa-3x"></i>
                    <p class="mt-2">Piezas y Componentes</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Proveedores', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/proveedores/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-truck fa-3x"></i>
                    <p class="mt-2">Proveedores</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Recibos', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/recibos/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-receipt fa-3x"></i>
                    <p class="mt-2">Recibos</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Reparaciones', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/reparaciones/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-wrench fa-3x"></i>
                    <p class="mt-2">Reparaciones</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Roles', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/roles/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-user-shield fa-3x"></i>
                    <p class="mt-2">Roles</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Técnicos', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/tecnicos/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-user-cog fa-3x"></i>
                    <p class="mt-2">Técnicos</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Tickets', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/tickets/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-ticket-alt fa-3x"></i>
                    <p class="mt-2">Tickets</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Usuarios', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/usuarios/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-users-cog fa-3x"></i>
                    <p class="mt-2">Usuarios</p>
                </a>
            </div>
            <?php } ?>
            
            <?php if (tienePermiso('Ventas Accesorios', $permisos_usuario)) { ?>
            <div class="col-md-2 mb-4">
                <a href="administrador/ventas_accesorios/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-shopping-cart fa-3x"></i>
                    <p class="mt-2">Ventas Accesorios</p>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Pie de Página -->
    <footer class="text-center py-4">
        <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
    </footer>

    <!-- Enlazar archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script src="scripts/nav.js"></script>
</body>
</html>
