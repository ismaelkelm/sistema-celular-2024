<?php
session_start();
require_once '../../mi_sistema/base_datos/db.php'; // Asegúrate de que la ruta sea correcta

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])) {
    header("Location: login/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];

// Consultar el nombre del rol
$sql = "SELECT nombre FROM roles WHERE id_roles = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $stmt->bind_result($role_name);
    $stmt->fetch();
    $stmt->close();

    // Redirigir según el rol
    switch ($role_name) {
        case 'Administrador':
            header("Location: ../../mi_sistema/administrador/administrador.php");
            break;
        case 'Administrativo':
            header("Location: ../../mi_sistema/administrativo/administrativo.php");
            break;
        case 'Técnico':
            header("Location: ../../mi_sistema/tecnico/tecnico.php");
            break;
        case 'Cliente':
            header("Location: ../../mi_sistema/cliente/cliente.php");
            break;
        default:
            header("Location: login/login.php?error=" . urlencode("Rol de usuario no reconocido."));
            break;
    }
    exit;
} else {
    header("Location: login/login.php?error=" . urlencode("Error en la consulta de roles."));
    exit;
}

$conn->close();
?>
