<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Obtén el nombre del rol del usuario desde la sesión
$role_name = $_SESSION['role'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Bienvenido, <?php echo htmlspecialchars($role_name); ?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
</body>
</html>
