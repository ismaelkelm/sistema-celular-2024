<?php
// Función para obtener el ícono basado en el permiso
function getIconClass($permission) {
    $icons = [
        'Accesorios' => 'box', // Se usa 'box' para accesorios
        'Clientes' => 'users', // Se usa 'users' para clientes
        'Detalle Facturas' => 'file-invoice', // Se usa 'file-invoice' para detalle de facturas
        'Detalle Reparaciones' => 'tools', // Se usa 'tools' para detalle de reparaciones
        'Dispositivos' => 'mobile-alt', // Se usa 'mobile-alt' para dispositivos
        'Empleados' => 'user-tie', // Se usa 'user-tie' para empleados
        'Facturas' => 'file-invoice-dollar', // Se usa 'file-invoice-dollar' para facturas
        'Notificaciones' => 'bell', // Se usa 'bell' para notificaciones
        'Pagos' => 'money-bill-wave', // Se usa 'money-bill-wave' para pagos
        'Pedidos de Reparación' => 'box-open', // Se usa 'box-open' para pedidos de reparación
        'Piezas y Componentes' => 'cogs', // Se usa 'cogs' para piezas y componentes
        'Proveedores' => 'truck', // Se usa 'truck' para proveedores
        'Recibos' => 'receipt', // Se usa 'receipt' para recibos
        'Reparaciones' => 'wrench', // Se usa 'wrench' para reparaciones
        'Roles' => 'user-shield', // Se usa 'user-shield' para roles
        'Técnicos' => 'user-cog', // Se usa 'user-cog' para técnicos
        'Tickets' => 'ticket-alt', // Se usa 'ticket-alt' para tickets
        'Usuarios' => 'users-cog', // Se usa 'users-cog' para usuarios
        'Ventas Accesorios' => 'shopping-cart', // Se usa 'shopping-cart' para ventas accesorios
        'Movimientos' => 'sync', // Se usa 'sync' para movimientos
        'Movimientos Financieros' => 'credit-card', // Se usa 'credit-card' para movimientos financieros
        'Password Resets' => 'lock', // Se usa 'lock' para password resets
        'Detalle Facturas' => 'file-invoice', // Repetido, se usa 'file-invoice' para detalle de facturas
        'Pedidos de Reparación' => 'box-open', // Repetido, se usa 'box-open' para pedidos de reparación
    ];
    return $icons[$permission] ?? 'question-circle';
}

// Función para obtener el estado de una orden
function getOrderStatus($order_number) {
    global $conn; // Asegúrate de que $conn está definido en db.php

    // Consulta para obtener el estado de la orden en la tabla 'pedidos_de_reparacion'
    $query = "SELECT estado FROM pedidos_de_reparacion WHERE numero_pedido = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
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
}
?>
