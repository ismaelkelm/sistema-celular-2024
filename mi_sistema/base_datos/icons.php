
<?php

require_once '../../mi_sistema/base_datos/db.php'; // Asegúrate de que db.php define y exporta $conn

// Función para obtener los permisos de un rol
function obtenerPermisos($user_id) {
    global $conn; // Asegúrate de que la variable $conn esté disponible
    $query = "
        SELECT p.descripcion, pr.estado
        FROM permisos_en_roles pr
        JOIN permisos p ON pr.id_permisos = p.id_permisos
        WHERE pr.id_roles = (
            SELECT id_roles FROM usuarios WHERE id_usuarios = ?
        )
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $permisos = [];
    while ($row = $result->fetch_assoc()) {
        $permisos[$row['descripcion']] = $row['estado'];
    }
    $stmt->close();
    return $permisos;
}


// Función para obtener los iconos y rutas de la base de datos
function obtenerIconos($user_id) {
    global $conn; // Asegúrate de que la variable $conn esté disponible
    $permisos = obtenerPermisos($user_id);

    // Define los iconos y rutas para cada rol
    $iconos_y_rutas = [
        'administrador' => [
            'accesorios_y_componentes' => ['icono' => 'fa-tools', 'ruta' => '../administrador/accesorios_componentes/index.php'],
            'area_tecnico' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/area_tecnico/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_compra' => ['icono' => 'fa-box', 'ruta' => '../administrador/detalle_compra/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'detalle_ventas_accesorios' => ['icono' => 'fa-shopping-cart', 'ruta' => '../administrador/detalle_ventas_accesorios/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'facturas_compra' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/facturas_compra/index.php'],
            'facturas_venta_reparacion' => ['icono' => 'fa-file-invoice-dollar', 'ruta' => '../administrador/facturas_venta_reparacion/index.php'],
            'factura_venta_accesorio' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/factura_venta_accesorio/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-history', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tipo_de_pago' => ['icono' => 'fa-money-bill-wave', 'ruta' => '../administrador/tipo_de_pago/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php']
        ],
        'administrativo' => [
            'accesorios_y_componentes' => ['icono' => 'fa-tools', 'ruta' => '../administrador/accesorios_componentes/index.php'],
            'area_tecnico' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/area_tecnico/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_compra' => ['icono' => 'fa-box', 'ruta' => '../administrador/detalle_compra/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'detalle_ventas_accesorios' => ['icono' => 'fa-shopping-cart', 'ruta' => '../administrador/detalle_ventas_accesorios/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'facturas_compra' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/facturas_compra/index.php'],
            'facturas_venta_reparacion' => ['icono' => 'fa-file-invoice-dollar', 'ruta' => '../administrador/facturas_venta_reparacion/index.php'],
            'factura_venta_accesorio' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/factura_venta_accesorio/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-history', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tipo_de_pago' => ['icono' => 'fa-money-bill-wave', 'ruta' => '../administrador/tipo_de_pago/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php']
        ],
        'tecnico' => [
            'accesorios_y_componentes' => ['icono' => 'fa-tools', 'ruta' => '../administrador/accesorios_componentes/index.php'],
            'area_tecnico' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/area_tecnico/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_compra' => ['icono' => 'fa-box', 'ruta' => '../administrador/detalle_compra/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'detalle_ventas_accesorios' => ['icono' => 'fa-shopping-cart', 'ruta' => '../administrador/detalle_ventas_accesorios/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'facturas_compra' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/facturas_compra/index.php'],
            'facturas_venta_reparacion' => ['icono' => 'fa-file-invoice-dollar', 'ruta' => '../administrador/facturas_venta_reparacion/index.php'],
            'factura_venta_accesorio' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/factura_venta_accesorio/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-history', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tipo_de_pago' => ['icono' => 'fa-money-bill-wave', 'ruta' => '../administrador/tipo_de_pago/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php']
        ],
        'cliente' => [
            'accesorios_y_componentes' => ['icono' => 'fa-tools', 'ruta' => '../administrador/accesorios_componentes/index.php'],
            'area_tecnico' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/area_tecnico/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_compra' => ['icono' => 'fa-box', 'ruta' => '../administrador/detalle_compra/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'detalle_ventas_accesorios' => ['icono' => 'fa-shopping-cart', 'ruta' => '../administrador/detalle_ventas_accesorios/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'facturas_compra' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/facturas_compra/index.php'],
            'facturas_venta_reparacion' => ['icono' => 'fa-file-invoice-dollar', 'ruta' => '../administrador/facturas_venta_reparacion/index.php'],
            'factura_venta_accesorio' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/factura_venta_accesorio/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-history', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tipo_de_pago' => ['icono' => 'fa-money-bill-wave', 'ruta' => '../administrador/tipo_de_pago/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php']
        ],
        'empleado' => [

            'accesorios_y_componentes' => ['icono' => 'fa-tools', 'ruta' => '../administrador/accesorios_componentes/index.php'],
            'area_tecnico' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/area_tecnico/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_compra' => ['icono' => 'fa-box', 'ruta' => '../administrador/detalle_compra/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'detalle_ventas_accesorios' => ['icono' => 'fa-shopping-cart', 'ruta' => '../administrador/detalle_ventas_accesorios/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'facturas_compra' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/facturas_compra/index.php'],
            'facturas_venta_reparacion' => ['icono' => 'fa-file-invoice-dollar', 'ruta' => '../administrador/facturas_venta_reparacion/index.php'],
            'factura_venta_accesorio' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/factura_venta_accesorio/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-history', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tipo_de_pago' => ['icono' => 'fa-money-bill-wave', 'ruta' => '../administrador/tipo_de_pago/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php']
        ],
    ];

    // Obtener el rol del usuario
    $query_rol = "SELECT descripcion FROM roles WHERE id_roles = (SELECT id_roles FROM usuarios WHERE id_usuarios = ?)";
    $stmt_rol = $conn->prepare($query_rol);
    $stmt_rol->bind_param("i", $user_id);
    $stmt_rol->execute();
    $result_rol = $stmt_rol->get_result();
    $rol_row = $result_rol->fetch_assoc();
    $rol_nombre = $rol_row['descripcion'];
    $stmt_rol->close();

    // Filtra los iconos según los permisos y el rol
    $iconos_visibles = [];
    if (isset($iconos_y_rutas[$rol_nombre])) {
        foreach ($iconos_y_rutas[$rol_nombre] as $tabla => $icono_y_ruta) {
            if (isset($permisos[$tabla]) && $permisos[$tabla] == 1) {
                $iconos_visibles[$tabla] = $icono_y_ruta;
            }
        }
    }

    return $iconos_visibles;
}

// Obtener el ID del usuario logueado
if (!isset($_SESSION['user_id'])) {
    die('Usuario no autenticado.');
}
$user_id = $_SESSION['user_id'];

$iconos_visibles = obtenerIconos($user_id);

