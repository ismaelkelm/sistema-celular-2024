<?php
function getIconClass($permission) {
    $iconMap = array(
        'Accesorios' => 'tools',
        'Clientes' => 'user',
        'Detalle Facturas' => 'file-invoice',
        'Detalle Reparaciones' => 'wrench',
        'Dispositivos' => 'mobile-alt',
        'Empleados' => 'users',
        'Facturas' => 'file-invoice-dollar',
        'Movimientos' => 'exchange-alt',
        'Movimientos Financieros' => 'dollar-sign',
        'Notificaciones' => 'bell',
        'Pagos' => 'credit-card',
        'Password Resets' => 'key',
        'Pedidos de Reparación' => 'shopping-cart',
        'Piezas y Componentes' => 'cogs',
        'Proveedores' => 'truck',
        'Recibos' => 'receipt',
        'Reparaciones' => 'tools',
        'Roles' => 'lock',
        'Técnicos' => 'hammer',
        'Tickets' => 'ticket-alt',
        'Usuarios' => 'user-cog',
        'Ventas Accesorios' => 'tag'
    );

    return isset($iconMap[$permission]) ? $iconMap[$permission] : 'question-circle'; // 'question-circle' como icono por defecto
}

function getPermissionRoute($permission, $role) {
    // Definir las rutas asociadas a cada permiso para cada rol
    $routeMap = array(
        'Administrador' => array(
            'Accesorios' => '../administrador/accesorios/index.php',
            'Clientes' => '../administrador/clientes/index.php',
            'Detalle Facturas' => '../administrador/detalle_facturas/index.php',
            'Detalle Reparaciones' => '../administrador/detalle_reparaciones/index.php',
            'Dispositivos' => '../administrador/dispositivos/index.php',
            'Empleados' => '../administrador/empleados/index.php',
            'Facturas' => '../administrador/facturas/index.php',
            'Movimientos' => '../administrador/movimientos/index.php',
            'Movimientos Financieros' => '../administrador/movimiento_financiero/index.php',
            'Notificaciones' => '../administrador/notificaciones/index.php',
            'Pagos' => '../administrador/pagos/index.php',
            'Password Resets' => '../administrador/password_resets/index.php',
            'Pedidos de Reparación' => '../administrador/pedidos_de_reparacion/index.php',
            'Piezas y Componentes' => '../administrador/piezas_y_componentes/index.php',
            'Proveedores' => '../administrador/proveedores/index.php',
            'Recibos' => '../administrador/recibos/index.php',
            'Reparaciones' => '../administrador/reparaciones/index.php',
            'Roles' => '../administrador/roles/index.php',
            'Técnicos' => '../administrador/tecnicos/index.php',
            'Tickets' => '../administrador/tickets/index.php',
            'Usuarios' => '../administrador/usuarios/index.php',
            'Ventas Accesorios' => '../administrador/ventas_accesorios/index.php'
        ),
        'Técnico' => array(
            'Accesorios' => '../tecnico/accesorios/index.php',
            'Clientes' => '../tecnico/clientes/index.php',
            'Detalle Facturas' => '../tecnico/detalle_facturas/index.php',
            'Detalle Reparaciones' => '../tecnico/detalle_reparaciones/index.php',
            'Dispositivos' => '../tecnico/dispositivos/index.php',
            'Empleados' => '../tecnico/empleados/index.php',
            'Facturas' => '../tecnico/facturas/index.php',
            'Movimientos' => '../tecnico/movimientos/index.php',
            'Movimientos Financieros' => '../tecnico/movimiento_financiero/index.php',
            'Notificaciones' => '../tecnico/notificaciones/index.php',
            'Pagos' => '../tecnico/pagos/index.php',
            'Password Resets' => '../tecnico/password_resets/index.php',
            'Pedidos de Reparación' => '../tecnico/pedidos_de_reparacion/index.php',
            'Piezas y Componentes' => '../tecnico/piezas_y_componentes/index.php',
            'Proveedores' => '../tecnico/proveedores/index.php',
            'Recibos' => '../tecnico/recibos/index.php',
            'Reparaciones' => '../tecnico/reparaciones/index.php',
            'Roles' => '../tecnico/roles/index.php',
            'Técnicos' => '../tecnico/tecnicos/index.php',
            'Tickets' => '../tecnico/tickets/index.php',
            'Usuarios' => '../tecnico/usuarios/index.php',
            'Ventas Accesorios' => '../tecnico/ventas_accesorios/index.php'
        ),
        'Cliente' => array(
            'Accesorios' => '../cliente/accesorios/index.php',
            'Clientes' => '../cliente/clientes/index.php',
            'Detalle Facturas' => '../cliente/detalle_facturas/index.php',
            'Detalle Reparaciones' => '../cliente/detalle_reparaciones/index.php',
            'Dispositivos' => '../cliente/dispositivos/index.php',
            'Empleados' => '../cliente/empleados/index.php',
            'Facturas' => '../cliente/facturas/index.php',
            'Movimientos' => '../cliente/movimientos/index.php',
            'Movimientos Financieros' => '../cliente/movimiento_financiero/index.php',
            'Notificaciones' => '../cliente/notificaciones/index.php',
            'Pagos' => '../cliente/pagos/index.php',
            'Password Resets' => '../cliente/password_resets/index.php',
            'Pedidos de Reparación' => '../cliente/pedidos_de_reparacion/index.php',
            'Piezas y Componentes' => '../cliente/piezas_y_componentes/index.php',
            'Proveedores' => '../cliente/proveedores/index.php',
            'Recibos' => '../cliente/recibos/index.php',
            'Reparaciones' => '../cliente/reparaciones/index.php',
            'Roles' => '../cliente/roles/index.php',
            'Técnicos' => '../cliente/tecnicos/index.php',
            'Tickets' => '../cliente/tickets/index.php',
            'Usuarios' => '../cliente/usuarios/index.php',
            'Ventas Accesorios' => '../cliente/ventas_accesorios/index.php'
        ),
        'Administrativo' => array(
            'Accesorios' => '../administrativo/accesorios/index.php',
            'Clientes' => '../administrativo/clientes/index.php',
            'Detalle Facturas' => '../administrativo/detalle_facturas/index.php',
            'Detalle Reparaciones' => '../administrativo/detalle_reparaciones/index.php',
            'Dispositivos' => '../administrativo/dispositivos/index.php',
            'Empleados' => '../administrativo/empleados/index.php',
            'Facturas' => '../administrativo/facturas/index.php',
            'Movimientos' => '../administrativo/movimientos/index.php',
            'Movimientos Financieros' => '../administrativo/movimiento_financiero/index.php',
            'Notificaciones' => '../administrativo/notificaciones/index.php',
            'Pagos' => '../administrativo/pagos/index.php',
            'Password Resets' => '../administrativo/password_resets/index.php',
            'Pedidos de Reparación' => '../administrativo/pedidos_de_reparacion/index.php',
            'Piezas y Componentes' => '../administrativo/piezas_y_componentes/index.php',
            'Proveedores' => '../administrativo/proveedores/index.php',
            'Recibos' => '../administrativo/recibos/index.php',
            'Reparaciones' => '../administrativo/reparaciones/index.php',
            'Roles' => '../administrativo/roles/index.php',
            'Técnicos' => '../administrativo/tecnicos/index.php',
            'Tickets' => '../administrativo/tickets/index.php',
            'Usuarios' => '../administrativo/usuarios/index.php',
            'Ventas Accesorios' => '../administrativo/ventas_accesorios/index.php'
        )
    );

    // Retornar la ruta según el rol
    return isset($routeMap[$role][$permission]) ? $routeMap[$role][$permission] : '#'; // '#' como ruta por defecto
}


// Devuelve el estado de una orden de reparación y la información del cliente
function getOrderStatus($order_number, $customer_name, $customer_phone) {
    global $conn; // Asegúrate de que $conn está definido en db.php

    try {
        // Consulta para obtener el estado de la orden, nombre y teléfono del cliente
        $query = "
            SELECT pr.estado, c.nombre, c.telefono
            FROM pedidos_de_reparacion pr
            JOIN clientes c ON pr.id_clientes = c.id_clientes
            WHERE pr.numero_pedido = ? AND c.nombre = ? AND c.telefono = ?
        ";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("sss", $order_number, $customer_name, $customer_phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return [
                'estado' => $row['estado'],
                'nombre' => $row['nombre'], // Puedes eliminar o comentar esta línea si no quieres mostrar el nombre
                'telefono' => $row['telefono']
            ];
        } else {
            return null; // No se encontró la orden
        }
    } catch (Exception $e) {
        error_log($e->getMessage()); // Registra el error para su posterior revisión
        return null;
    }
}
?>
