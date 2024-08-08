<?php
session_start(); // Asegúrate de que la sesión está iniciada

<<<<<<< HEAD
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login/login.php");
=======
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location:../login/login.php");
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc
    exit;
}

$usuario_rol = $_SESSION['role'];
$inicio_url = "../index.php"; // Cambia esto a la URL correcta para tu inicio
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Navegación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .navbar-brand {
            font-size: 1.75rem;
            font-weight: bold;
        }
        .nav-link {
            font-size: 1.1rem;
            padding: 0.75rem 1rem;
        }
        .nav-link i {
            margin-right: 0.5rem;
        }
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,.75);
        }
        .navbar-dark .navbar-nav .nav-link:hover, 
        .navbar-dark .navbar-nav .nav-link:focus {
            color: #fff;
        }
        .btn-danger {
            font-size: 1.1rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo htmlspecialchars($inicio_url); ?>">
            Inicio
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
<<<<<<< HEAD
                <?php if ($usuario_rol === 'administrador'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cogs"></i> Administrador
                        </a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="../base_datos/gestionar_permisos.php">
                                <i class="fas fa-box"></i> Permisos
                            </a>
                            <a class="dropdown-item" href="../tecnico/tecnico.php">
                                <i class="fas fa-users"></i> Técnicos
                            </a>
                            <a class="dropdown-item" href="../cliente/cliente.php">
                                <i class="fas fa-file-invoice"></i> Clientes
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cogs"></i> Lista de Reparaciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="../tecnico/listar_reparaciones.php">
                                Listar Reparaciones
                            </a>
                            <a class="dropdown-item" href="../tecnico/gestionar_tareas.php">
                                Gestionar Tareas
                            </a>
                            <a class="dropdown-item" href="../tecnico/notificar_completado.php">
                                Notificar Completado
                            </a>
                        </div>
                    </li>
                <?php elseif ($usuario_rol === 'administrativo'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cogs"></i> Administrativo
                        </a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="../administrativo/gestionar_tareas.php">
                                <i class="fas fa-tasks"></i> Gestionar Tareas
                            </a>
                            <a class="dropdown-item" href="../administrativo/listar_reparaciones.php">
                                <i class="fas fa-chart-line"></i> Lista de reparaciones
                            </a>
                            <a class="dropdown-item" href="../administrativo/enviar_notificacion.php">
                                <i class="fas fa-money-bill"></i> Enviar Notificacion
                            </a>
                        </div>
                    </li>
                <?php elseif ($usuario_rol === 'tecnico'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tecnicoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-tools"></i> Reparaciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="tecnicoDropdown">
                            <a class="dropdown-item" href="../tecnico/listar_reparaciones.php">
                                Listar Reparaciones
                            </a>
                            <a class="dropdown-item" href="../tecnico/gestionar_tareas.php">
                                Gestionar Tareas
                            </a>
                            <a class="dropdown-item" href="../tecnico/notificar_completado.php">
                                Notificar Completado
                            </a>
                            <a class="dropdown-item" href="../tecnico/ver_notificacion.php">
                                Ver Notificaciones
                            </a>
                        </div>
                    </li>
                <?php elseif ($usuario_rol === 'cliente'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="clienteDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> Cliente
                        </a>
                        <div class="dropdown-menu" aria-labelledby="clienteDropdown">
                            <a class="dropdown-item" href="../cliente/perfil.php">
                                <i class="fas fa-user-circle"></i> Mi Perfil
                            </a>
                            <a class="dropdown-item" href="../cliente/reparaciones.php">
                                <i class="fas fa-repair"></i> Mis Reparaciones
                            </a>
                            <a class="dropdown-item" href="../cliente/notificaciones.php">
                                <i class="fas fa-bell"></i> Notificaciones
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
=======
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
                <li class="nav-item">
                    <a class="nav-link" href="../cliente/cliente.php">
                        <i class="fas fa-file-invoice"></i> FActuracion
                    </a>
                </li>
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="../login/forgot_change.html" class="btn btn-danger">
                        <i class="fas fa-cogs"></i> Cambiar Contraseña
                    </a>
<<<<<<< HEAD
                    <a href="../login/login.php" class="btn btn-danger">
=======
                </li>
                <li class="nav-item">
                    <a href="../login/logout.php" class="btn btn-danger">
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc
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
