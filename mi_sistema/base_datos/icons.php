<?php
// icons.php
require_once '../../mi_sistema/base_datos/db.php';

// Función para obtener los permisos de un rol
function obtenerPermisos($user_id) {
    global $conn;
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

// Función para obtener los iconos de la base de datos
function obtenerIconos($user_id) {
    $permisos = obtenerPermisos($user_id);

    // Define los iconos para cada tabla
    $iconos = [
        'accesorios' => 'fa-tools',
        'clientes' => 'fa-user',
        'detalle_facturas' => 'fa-file-invoice',
        'detalle_reparaciones' => 'fa-wrench',
        'dispositivos' => 'fa-laptop',
        'empleados' => 'fa-people',
        'facturas' => 'fa-file-alt',
        'movimientos' => 'fa-exchange-alt',
        'movimientos_financieros' => 'fa-dollar-sign',
        'notificaciones' => 'fa-bell',
        'pagos' => 'fa-credit-card',
        'password_resets' => 'fa-key',
        'pedidos_de_reparacion' => 'fa-repair',
        'permisos' => 'fa-shield-alt',
        'permisos_en_roles' => 'fa-user-shield',
        'piezas_y_componentes' => 'fa-cogs',
        'proveedores' => 'fa-truck',
        'recibos' => 'fa-receipt',
        'reparaciones' => 'fa-hammer',
        'roles' => 'fa-users-cog',
        'tecnicos' => 'fa-tools',
        'tickets' => 'fa-ticket-alt',
        'usuarios' => 'fa-user-cog',
        'ventas_accesorios' => 'fa-tag'
    ];

    // Filtra los iconos según los permisos
    $iconos_visibles = [];
    foreach ($iconos as $tabla => $icono) {
        if (isset($permisos[$tabla]) && $permisos[$tabla] == 1) {
            $iconos_visibles[$tabla] = $icono;
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
?>
