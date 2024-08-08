<?php
// Incluir funciones y la conexión a la base de datos
include 'functions.php';
require_once '../../mi_sistema/base_datos/db.php';

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
$id_roles = $row['id_roles'];

// Verificar si el usuario es administrador
$query = "SELECT nombre FROM roles WHERE id_roles = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $id_roles);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role_name = $row['nombre'];

if ($role_name != 'administrador') {
    die('Acceso denegado.');
}

// Obtener la lista de roles
$query = "SELECT id_roles, nombre FROM roles";
$result = $conn->query($query);

if ($result === false) {
    die('Error en la consulta: ' . $conn->error);
}

$roles = [];
while ($row = $result->fetch_assoc()) {
    $roles[] = $row;
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Roles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .btn-back {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <a href="javascript:history.back()" class="btn btn-secondary btn-back">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h2 class="text-center mb-4">Panel de Control - Roles</h2>
        <div class="row">
            <?php foreach ($roles as $rol): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($rol['nombre']); ?></h5>
                            <form method="POST" action="./permisos.php">
                                <input type="hidden" name="rol_id" value="<?php echo htmlspecialchars($rol['id_roles']); ?>">
                                <button type="submit" class="btn btn-primary">Ver Permisos</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
