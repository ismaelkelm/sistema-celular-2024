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
        'name' => 'Técnico',
        'permissions' => [
            'Accesorios',
            'Clientes',
            'Detalle Reparaciones',
            'Dispositivos',
            'Notificaciones',
            'Pedidos de Reparación',
            'Reparaciones'
        ]
    ],
    '3' => [
        'name' => 'Administrativo',
        'permissions' => [
            'Clientes',
            'Notificaciones',
            'Pedidos de Reparación'
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
