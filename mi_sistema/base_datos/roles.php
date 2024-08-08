<?php
require_once '../../mi_sistema/base_datos/db.php';

// Incluir funciones
include 'functions.php';

// Verificar si el usuario está logueado
session_start();
if (!isset($_SESSION['user_id'])) {
    die('Usuario no autenticado.');
}

// Obtener el rol del usuario desde la base de datos
$user_id = $_SESSION['user_id'];
$query = "SELECT id_roles FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role_id = $row['id_roles'];
$stmt->close();

// Obtener el nombre del rol desde la base de datos
$query = "SELECT nombre FROM roles WHERE id_roles = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role_name = $row['nombre'];
$stmt->close();

// Obtener permisos del rol desde la base de datos
$query = "
    SELECT p.descripcion, pr.estado
    FROM permisos_en_roles pr
    JOIN permisos p ON pr.permisos_idPermisos = p.idPermisos
    WHERE pr.roles_id_roles = ?
";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();

$permisos_del_rol = array();
while ($row = $result->fetch_assoc()) {
    $permisos_del_rol[] = array(
        'descripcion' => $row['descripcion'],
        'estado' => $row['estado']
    );
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permisos del Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 2rem;
        }
        .list-group-item {
            border-radius: 0.25rem;
        }
        .btn-back {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="btn btn-secondary btn-back">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h2 class="text-center mb-4">Permisos del Rol '<?php echo htmlspecialchars($role_name); ?>'</h2>
        <ul class="list-group">
            <?php foreach ($permisos_del_rol as $permiso): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <i class="fas fa-<?php echo getIconClass($permiso['descripcion']); ?>"></i>
                    <strong><?php echo htmlspecialchars($permiso['descripcion']); ?></strong>
                    <span>
                        <?php if ($role_name === 'Administrador' || $permiso['estado']): ?>
                            <i class="fas fa-<?php echo $permiso['estado'] ? 'check-circle text-success' : 'times-circle text-danger'; ?>"></i>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-muted"></i>
                        <?php endif; ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
