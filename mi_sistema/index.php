<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login/login.php");
    exit;
}

// Incluir el archivo de roles
require_once 'roles.php';

// Obtener el ID de rol del usuario desde la sesión
$user_role_id = isset($_SESSION['role_id']) ? (int) $_SESSION['role_id'] : 0;

// Depuración: Mostrar el rol del usuario y la página a la que se está redirigiendo
echo "<p>Rol del Usuario: $user_role_id</p>";
echo "<p>Redirigiendo a: ";

switch ($user_role_id) {
    case 1: // Administrador
        echo "administrador/administrador.php</p>";
        header("Location: administrador/administrador.php");
        break;
    case 2: // Administrativo
        echo "administrativo/administrativo.php</p>";
        header("Location: administrativo/administrativo.php");
        break;
    case 3: // Técnico
        echo "tecnico/tecnico.php</p>";
        header("Location: tecnico/tecnico.php");
        break;
    case 4: // Cliente
        echo "cliente/cliente.php</p>";
        header("Location: cliente/cliente.php");
        break;
    default:
        echo "login/login.php?error=" . urlencode("Rol desconocido") . "</p>";
        header("Location: login/login.php?error=" . urlencode("Rol desconocido"));
        break;
}
exit;
?>
