<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="/mi_sistema/estilos/login.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Inicio de Sesión</h2>
        <!-- Formulario de inicio de sesión -->
        <form action="../login/login_process.php" method="post">
            <div class="form-group mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" required>
            </div>

            <div class="form-group mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
            </div>

            <div class="d-flex justify-content-center">
                <!-- Botón de ir a la página principal -->
                <button type="button" class="btn btn-secondary mx-2" onclick="window.location.href='../index.php';">
                    <i class="bi bi-house"></i>
                </button>
                <!-- Botón de enviar el formulario (dentro del formulario) -->
                <button type="submit" class="btn btn-primary mx-2">
                    <i class="bi bi-door-open"></i>
                </button>
                <!-- Botón de registro -->
                <button type="button" class="btn btn-secondary mx-2" onclick="window.location.href='register.php';">
                    <i class="bi bi-person-plus"></i>
                </button>
            </div>
        </form>

        <!-- Mostrar mensaje de error si existe -->
        <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
