<?php
// Asegúrate de que session_start() no se llame aquí si ya se ha llamado en otro archivo.
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión solo si aún no está iniciada
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Navegación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../estilos/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Enlace para recargar la página -->
        <a class="navbar-brand" href="#" onclick="window.location.reload(); return false;">
            Mi Empresa
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../base_datos/gestionar_permisos.php">
                        <i class="fas fa-box"></i> Permisos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../tecnico/tecnico.php">
                        <i class="fas fa-users"></i> Técnicos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../cliente/cliente.php">
                        <i class="fas fa-file-invoice"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../administrativo/administrativo.php">
                        <i class="fas fa-wrench"></i> Administrativo
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i> Notificaciones
                    </a>
                    <div class="dropdown-menu" aria-labelledby="notificationsDropdown">
                        <!-- Notificaciones dinámicas -->
                        <a class="dropdown-item" href="#">Notificación 1</a>
                        <a class="dropdown-item" href="#">Notificación 2</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Ver todas</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/register.php">
                        <i class="fas fa-lock"></i> Cambiar Contraseña
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../login/logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
