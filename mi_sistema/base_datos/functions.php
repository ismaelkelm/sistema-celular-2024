<?php
// Función para obtener el ícono basado en el permiso
function getIconClass($permission) {
    $icons = [
        'Accesorios' => 'box',
        'Clientes' => 'users',
        'Detalle Facturas' => 'file-invoice',
        'Detalle Reparaciones' => 'tools',
        'Dispositivos' => 'mobile-alt',
        'Empleados' => 'user-tie',
        'Facturas' => 'file-invoice-dollar',
        'Notificaciones' => 'bell',
        'Pagos' => 'money-bill-wave',
        'Pedidos de Reparación' => 'box-open',
        'Piezas y Componentes' => 'cogs',
        'Proveedores' => 'truck',
        'Recibos' => 'receipt',
        'Reparaciones' => 'wrench',
        'Roles' => 'user-shield',
        'Técnicos' => 'user-cog',
        'Tickets' => 'ticket-alt',
        'Usuarios' => 'users-cog',
        'Ventas Accesorios' => 'shopping-cart',
        'Movimientos' => 'sync',
        'Movimientos Financieros' => 'credit-card',
        'Password Resets' => 'lock'
    ];
    return $icons[$permission] ?? 'question-circle'; // Devuelve 'question-circle' si no se encuentra el permiso
}

// Función para obtener el estado de una orden
function getOrderStatus($order_number) {
    global $conn; // Asegúrate de que $conn está definido en db.php

    try {
        // Consulta para obtener el estado de la orden en la tabla 'pedidos_de_reparacion'
        $query = "SELECT estado FROM pedidos_de_reparacion WHERE numero_pedido = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $order_number); // Usa 's' para cadenas
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['estado'];
        } else {
            return null;
        }
    } catch (Exception $e) {
        error_log($e->getMessage()); // Registra el error para su posterior revisión
        return null;
    }
}
?>
