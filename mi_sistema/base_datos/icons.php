<?php

require_once '../../mi_sistema/base_datos/db.php'; // Asegúrate de que db.php defina y exporte $conn

// Función para obtener los permisos de un rol
function obtenerPermisos($user_id) {
    global $conn; // Asegúrate de que la variable $conn esté disponible
    $query = "
        SELECT p.descripcion, pr.estado
        FROM permisos_en_roles pr
        JOIN permisos p ON pr.permisos_idPermisos = p.idPermisos
        WHERE pr.roles_id_roles = (
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
            'accesorios' => ['icono' => 'fa-tools', 'ruta' => '../administrador/accesorios/index.php'],
            'caja' => ['icono' => 'fa-cash-register', 'ruta' => '../administrador/caja/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_facturas' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/detalle_facturas/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'empleados' => ['icono' => 'fa-people', 'ruta' => '../administrador/empleados/index.php'],
            'facturas' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/facturas/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'movimientos' => ['icono' => 'fa-exchange-alt', 'ruta' => '../administrador/movimientos/index.php'],
            'movimientos_financieros' => ['icono' => 'fa-dollar-sign', 'ruta' => '../administrador/movimientos_financieros/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'password_resets' => ['icono' => 'fa-key', 'ruta' => '../administrador/password_resets/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'piezas_y_componentes' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/piezas_y_componentes/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'recibos' => ['icono' => 'fa-receipt', 'ruta' => '../administrador/recibos/index.php'],
            'reparaciones' => ['icono' => 'fa-hammer', 'ruta' => '../administrador/reparaciones/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tickets' => ['icono' => 'fa-ticket-alt', 'ruta' => '../administrador/tickets/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php'],
            'ventas_accesorios' => ['icono' => 'fa-tag', 'ruta' => '../administrador/ventas_accesorios/index.php']
        ],
        'administrativo' => [
            'accesorios' => ['icono' => 'fa-tools', 'ruta' => '../administrativo/accesorios/index.php'],
            'caja' => ['icono' => 'fa-cash-register', 'ruta' => '../administrativo/caja/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrativo/clientes/index.php'],
            'detalle_facturas' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/detalle_facturas/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrativo/detalle_reparaciones/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrativo/dispositivos/index.php'],
            'empleados' => ['icono' => 'fa-people', 'ruta' => '../administrador/empleados/index.php'],
            'facturas' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/facturas/index.php'],
            'historial_cambios_contrasena' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/historial_cambios_contrasena/index.php'],
            'movimientos' => ['icono' => 'fa-exchange-alt', 'ruta' => '../administrador/movimientos/index.php'],
            'movimientos_financieros' => ['icono' => 'fa-dollar-sign', 'ruta' => '../administrador/movimientos_financieros/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrativo/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'piezas_y_componentes' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/piezas_y_componentes/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'recibos' => ['icono' => 'fa-receipt', 'ruta' => '../administrador/recibos/index.php'],
            'reparaciones' => ['icono' => 'fa-hammer', 'ruta' => '../administrador/reparaciones/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tickets' => ['icono' => 'fa-ticket-alt', 'ruta' => '../administrador/tickets/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php'],
            'ventas_accesorios' => ['icono' => 'fa-tag', 'ruta' => '../administrador/ventas_accesorios/index.php']
        ],
        'tecnico' => [
            'accesorios' => ['icono' => 'fa-tools', 'ruta' => '../tecnico/accesorios/index.php'],
            'caja' => ['icono' => 'fa-cash-register', 'ruta' => '../administrador/caja/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_facturas' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/detalle_facturas/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../tecnico/detalle_reparaciones/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../tecnico/dispositivos/index.php'],
            'empleados' => ['icono' => 'fa-people', 'ruta' => '../administrador/empleados/empleados.php'],
            'facturas' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/facturas/index.php'],
            'movimientos' => ['icono' => 'fa-exchange-alt', 'ruta' => '../administrador/movimientos/index.php'],
            'movimientos_financieros' => ['icono' => 'fa-dollar-sign', 'ruta' => '../administrador/movimientos_financieros/index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'password_resets' => ['icono' => 'fa-key', 'ruta' => '../administrador/password_resets/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../tecnico/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'piezas_y_componentes' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/piezas_y_componentes/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'recibos' => ['icono' => 'fa-receipt', 'ruta' => '../administrador/recibos/index.php'],
            'reparaciones' => ['icono' => 'fa-hammer', 'ruta' => '../administrador/reparaciones/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tickets' => ['icono' => 'fa-ticket-alt', 'ruta' => '../administrador/tickets/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php'],
            'ventas_accesorios' => ['icono' => 'fa-tag', 'ruta' => '../administrador/ventas_accesorios/index.php']
        ],
        'cliente' => [
            'accesorios' => ['icono' => 'fa-tools', 'ruta' => '../cliente/accesorios/index.php'],
            'caja' => ['icono' => 'fa-cash-register', 'ruta' => '../administrador/caja/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_facturas' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/detalle_facturas/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'empleados' => ['icono' => 'fa-people', 'ruta' => '../administrador/empleados/empleados.php'],
            'facturas' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/facturas/index.php'],
            'movimientos' => ['icono' => 'fa-exchange-alt', 'ruta' => '../administrador/movimientos/index.php'],
            'movimientos_financieros' => ['icono' => 'fa-dollar-sign', 'ruta' => '../administrador/movimientos_financieros//index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'password_resets' => ['icono' => 'fa-key', 'ruta' => '../administrador/password_resets/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../cliente/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'piezas_y_componentes' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/piezas_y_componentes/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'recibos' => ['icono' => 'fa-receipt', 'ruta' => '../administrador/recibos/index.php'],
            'reparaciones' => ['icono' => 'fa-hammer', 'ruta' => '../administrador/reparaciones/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tickets' => ['icono' => 'fa-ticket-alt', 'ruta' => '../administrador/tickets/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php'],
            'ventas_accesorios' => ['icono' => 'fa-tag', 'ruta' => '../administrador/ventas_accesorios/index.php']
        ],
        'Empleados' => [
            'accesorios' => ['icono' => 'fa-tools', 'ruta' => '../empleados/accesorios/index.php'],
            'caja' => ['icono' => 'fa-cash-register', 'ruta' => '../administrador/caja/index.php'],
            'clientes' => ['icono' => 'fa-user', 'ruta' => '../administrador/clientes/index.php'],
            'detalle_facturas' => ['icono' => 'fa-file-invoice', 'ruta' => '../administrador/detalle_facturas/index.php'],
            'detalle_reparaciones' => ['icono' => 'fa-wrench', 'ruta' => '../administrador/detalle_reparaciones/index.php'],
            'dispositivos' => ['icono' => 'fa-laptop', 'ruta' => '../administrador/dispositivos/index.php'],
            'empleados' => ['icono' => 'fa-people', 'ruta' => '../empleados/empleados/empleados.php'],
            'facturas' => ['icono' => 'fa-file-alt', 'ruta' => '../administrador/facturas/index.php'],
            'movimientos' => ['icono' => 'fa-exchange-alt', 'ruta' => '../administrador/movimientos/index.php'],
            'movimientos_financieros' => ['icono' => 'fa-dollar-sign', 'ruta' => '../administrador/movimientos_financieros//index.php'],
            'notificaciones' => ['icono' => 'fa-bell', 'ruta' => '../administrador/notificaciones/index.php'],
            'pagos' => ['icono' => 'fa-credit-card', 'ruta' => '../administrador/pagos/index.php'],
            'password_resets' => ['icono' => 'fa-key', 'ruta' => '../administrador/password_resets/index.php'],
            'pedidos_de_reparacion' => ['icono' => 'fa-repair', 'ruta' => '../administrador/pedidos_de_reparacion/index.php'],
            'permisos' => ['icono' => 'fa-shield-alt', 'ruta' => '../administrador/permisos/index.php'],
            'permisos_en_roles' => ['icono' => 'fa-user-shield', 'ruta' => '../administrador/permisos_en_roles/index.php'],
            'piezas_y_componentes' => ['icono' => 'fa-cogs', 'ruta' => '../administrador/piezas_y_componentes/index.php'],
            'proveedores' => ['icono' => 'fa-truck', 'ruta' => '../administrador/proveedores/index.php'],
            'recibos' => ['icono' => 'fa-receipt', 'ruta' => '../administrador/recibos/index.php'],
            'reparaciones' => ['icono' => 'fa-hammer', 'ruta' => '../administrador/reparaciones/index.php'],
            'roles' => ['icono' => 'fa-users-cog', 'ruta' => '../administrador/roles/index.php'],
            'tecnicos' => ['icono' => 'fa-tools', 'ruta' => '../administrador/tecnicos/index.php'],
            'tickets' => ['icono' => 'fa-ticket-alt', 'ruta' => '../administrador/tickets/index.php'],
            'usuarios' => ['icono' => 'fa-user-cog', 'ruta' => '../administrador/usuarios/index.php'],
            'ventas_accesorios' => ['icono' => 'fa-tag', 'ruta' => '../administrador/ventas_accesorios/index.php']
        ],
    ];

    // Obtener el rol del usuario
    $query_rol = "SELECT nombre FROM roles WHERE id_roles = (SELECT id_roles FROM usuarios WHERE id_usuarios = ?)";
    $stmt_rol = $conn->prepare($query_rol);
    $stmt_rol->bind_param("i", $user_id);
    $stmt_rol->execute();
    $result_rol = $stmt_rol->get_result();
    $rol_row = $result_rol->fetch_assoc();
    $rol_nombre = $rol_row['nombre'];
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

