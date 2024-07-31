<?php
session_start();
require_once '../base_datos/db.php'; // Ajustar la ruta según sea necesario
$roles = include('../base_datos/roles.php'); // Cargar el array de roles

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

// Supongamos que el ID del usuario está almacenado en $_SESSION['user_id']
$user_id = $_SESSION['user_id'];

// Consultar el rol del usuario
$query = "SELECT id_roles FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No se encontró el rol para el usuario.");
}

$row = $result->fetch_assoc();
$id_roles = $row['id_roles'];

// Verificar el rol del usuario
$role_name = '';
foreach ($roles as $role => $permissions) {
    if ($id_roles == array_search($role, array_keys($roles))) {
        $role_name = $role;
        break;
    }
}

if (empty($role_name) || !isset($roles[$role_name])) {
    header("Location: ../login/login.php");
    exit;
}

// Incluir el header.php para el contenido compartido
$pageTitle = "Administrativo - Mi Empresa"; // Establecer el título específico para esta página
include('../../mi_sistema/includes/header.php');
include_once('../base_datos/functions.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Contenido principal -->
    <div id="content-container" class="container my-4">
        <h2 class="text-center">Panel Administrativo</h2>

        <!-- Sección de permisos del rol actual -->
        <h3 class="text-center">Permisos del Rol Actual</h3>
        <div class="row">
            <?php
            if (isset($roles[$role_name]) && is_array($roles[$role_name])):
                foreach ($roles[$role_name] as $permission => $value):
                    if ($value === 'on'):
            ?>
                <div class="col-md-2 mb-4">
                    <a href="../administrador/<?php echo strtolower(str_replace(' ', '_', $permission)); ?>/index.php" class="btn btn-light p-3 d-block text-center">
                        <i class="fas fa-<?php echo getIconClass($permission); ?> fa-3x"></i>
                        <p class="mt-2"><?php echo ucfirst($permission); ?></p>
                    </a>
                </div>
            <?php
                    endif;
                endforeach;
            else:
                echo "<p>No hay permisos disponibles para este rol.</p>";
            endif;
            ?>
        </div>

        <!-- Sección para ver los permisos de otros roles -->
        <h3 class="text-center">Permisos de Otros Roles</h3>
        <div class="row">
            <?php
            foreach ($roles as $roleName => $permissions):
                if ($roleName != $role_name): // Opcional: ocultar el rol actual
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4><?php echo htmlspecialchars($roleName); ?></h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach ($permissions as $permission => $value): ?>
                                    <?php if ($value === 'on'): ?>
                                        <li class="list-group-item">
                                            <i class="fas fa-<?php echo getIconClass($permission); ?>"></i> <?php echo ucfirst($permission); ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>

    <footer class="text-center py-4">
        <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
