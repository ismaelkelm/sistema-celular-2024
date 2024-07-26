<?php
// Incluir cabecera y barra de navegación
include '../includes/header.php';
include '../includes/nav.php';
?>

<div class="container my-4">
    <h2>Panel del Administrador</h2>
    <p>Contenido específico para el administrador.</p>

    <!-- Menú principal con íconos -->
    <div class="row">
        <?php
        // Definir los íconos y las rutas para el administrador
        $icons = [
            ['icon' => 'fa-box', 'label' => 'Accesorios', 'path' => 'accesorios/index.php'],
            ['icon' => 'fa-users', 'label' => 'Clientes', 'path' => 'clientes/index.php'],
            ['icon' => 'fa-file-invoice', 'label' => 'Detalle Facturas', 'path' => 'detalle_facturas/index.php'],
            ['icon' => 'fa-tools', 'label' => 'Detalle Reparaciones', 'path' => 'detalle_reparaciones/index.php'],
            ['icon' => 'fa-mobile-alt', 'label' => 'Dispositivos', 'path' => 'dispositivos/index.php'],
            ['icon' => 'fa-user-tie', 'label' => 'Empleados', 'path' => 'empleados/index.php'],
            ['icon' => 'fa-file-invoice-dollar', 'label' => 'Facturas', 'path' => 'facturas/index.php'],
            ['icon' => 'fa-bell', 'label' => 'Notificaciones', 'path' => 'notificaciones/index.php'],
            ['icon' => 'fa-money-bill-wave', 'label' => 'Pagos', 'path' => 'pagos/index.php'],
            ['icon' => 'fa-box-open', 'label' => 'Pedidos de Reparación', 'path' => 'pedidos_de_reparacion/index.php'],
            ['icon' => 'fa-cogs', 'label' => 'Piezas y Componentes', 'path' => 'piezas_y_componentes/index.php'],
            ['icon' => 'fa-truck', 'label' => 'Proveedores', 'path' => 'proveedores/index.php'],
            ['icon' => 'fa-receipt', 'label' => 'Recibos', 'path' => 'recibos/index.php'],
            ['icon' => 'fa-wrench', 'label' => 'Reparaciones', 'path' => 'reparaciones/index.php'],
            ['icon' => 'fa-user-shield', 'label' => 'Roles', 'path' => 'roles/index.php'],
            ['icon' => 'fa-user-cog', 'label' => 'Técnicos', 'path' => 'tecnicos/index.php'],
            ['icon' => 'fa-ticket-alt', 'label' => 'Tickets', 'path' => 'tickets/index.php'],
            ['icon' => 'fa-users-cog', 'label' => 'Usuarios', 'path' => 'usuarios/index.php'],
            ['icon' => 'fa-shopping-cart', 'label' => 'Ventas Accesorios', 'path' => 'ventas_accesorios/index.php']
        ];

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
