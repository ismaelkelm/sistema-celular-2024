<?php
// functions.php

/**
 * Obtiene la ruta del archivo correspondiente a un permiso.
 *
 * @param string $permission Descripción del permiso.
 * @param string $userRole Rol del usuario.
 * @return string Ruta del archivo.
 */
function getPermissionRoute($permission, $userRole) {
    // Definir rutas de ejemplo basadas en permisos
    $routes = array(
        'Permisos' => 'permisos.php',
        'Técnicos' => 'tecnicos.php',
        'Clientes' => 'clientes.php',
        'Gestionar Tareas' => 'gestionar_tareas.php',
        'Lista de Reparaciones' => 'listar_reparaciones.php',
        'Enviar Notificación' => 'enviar_notificacion.php',
        // Agrega más rutas según sea necesario
    );

    return isset($routes[$permission]) ? $routes[$permission] : 'default.php'; // 'default.php' como ruta por defecto
}

/**
 * Obtiene la clase de ícono correspondiente a un permiso.
 *
 * @param string $permission Descripción del permiso.
 * @return string Clase de ícono.
 */
function getIconClass($permission) {
    $icons = array(
        'Permisos' => 'box',
        'Técnicos' => 'users',
        'Clientes' => 'file-invoice',
        'Gestionar Tareas' => 'tasks',
        'Lista de Reparaciones' => 'chart-line',
        'Enviar Notificación' => 'money-bill',
        // Agrega más iconos según sea necesario
    );

    return isset($icons[$permission]) ? $icons[$permission] : 'question-circle'; // 'question-circle' como ícono por defecto
}
