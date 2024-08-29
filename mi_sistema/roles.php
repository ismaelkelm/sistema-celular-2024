<?php
$roles = [
    '1' => [
        'name' => 'Administrador',
        'permissions' => [
            'Accesorios',
            'Clientes',
            'Detalle Facturas',
            'Detalle Reparaciones',
            'Dispositivos',
            'Empleados',
            'Facturas',
            'Movimientos',
            'Movimientos Financieros',
            'Notificaciones',
            'Pagos',
            'Pedidos de Reparación',
            'Piezas y Componentes',
            'Proveedores',
            'Recibos',
            'Reparaciones',
            'Roles',
            'Técnicos',
            'Tickets',
            'Usuarios',
            'Ventas Accesorios'
        ]
    ],
    '2' => [
        'name' => 'Administrativo',
        'permissions' => [
            'Accesorios',
            'Clientes',
            'Detalle Reparaciones',
            'Dispositivos',
            'Facturas',
            'Movimientos',
            'Notificaciones',
            'Pedidos de Reparación',
            'Reparaciones'
        ]
    ],
    '3' => [
        'name' => 'Técnico',
        'permissions' => [
            'Clientes',
            'Movimientos',
            'Notificaciones',
            'Pedidos de Reparación',
            'Reparaciones'
        ]
    ],
    '4' => [
        'name' => 'Cliente',
        'permissions' => [
            'Pedidos de Reparación',
            'Notificaciones'
        ]
    ]
];
?>
