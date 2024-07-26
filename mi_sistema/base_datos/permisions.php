<?php
// Definir el rol predeterminado (puedes cambiar esto a cualquier rol que desees simular)
$defaultRole = 'Administrativo';

// Cargar permisos
function getUserPermissions($role) {
    $permissions = include 'base_datos/permisos.php'; // Ajusta la ruta según tu estructura
    return isset($permissions[$role]) ? $permissions[$role] : [];
}

// Verificar acceso a una sección
function canAccess($section) {
    global $defaultRole; // Usar el rol predeterminado
    $permissions = getUserPermissions($defaultRole);
    return isset($permissions[$section]) && $permissions[$section] == 'on';
}

// Mostrar secciones basadas en permisos
function showSection($sectionName) {
    if (canAccess($sectionName)) {
        echo "<div class='section'>$sectionName</div>";
    } else {
        echo "<div class='section'>No tienes permiso para acceder a esta sección.</div>";
    }
}
?>
