<nav id="nav-container" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Mi Empresa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="base_datos/gestionar_permisos.php">
                    <i class="fas fa-box"></i> Permisos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tecnico/tecnico.php">
                    <i class="fas fa-users"></i> Tecnicos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cliente/cliente.php">
                    <i class="fas fa-file-invoice"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="administrativo/administrativo.php">
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
                    <a class="dropdown-item" href="ruta/todas_notificaciones.php">Notificación 1</a>
                    <a class="dropdown-item" href="ruta/todas_notificaciones.php">Notificación 2</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="ruta/todas_notificaciones.php">Ver todas</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cambiar_contrasena.php">
                    <i class="fas fa-lock"></i> Cambiar Contraseña
                </a>
            </li>
            <li class="nav-item">
             
                <a href="login/login.php" class="btn btn-danger">Cerrar Sesión</a>
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Enlazar los archivos JS de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
