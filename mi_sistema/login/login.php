<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Inicio de Sesión</h2>
        <form action="login_process.php" method="post">

            <div class="form-group">
                <label for="usuario">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" required>
            </div>

            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            
            <a href="register.php" class="btn btn-secondary">Regístrate aquí</a>
        </form>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <p class="mt-3">¿Olvidaste tu nombre de usuario o contraseña? <a href="#">Recupera aquí.</a></p>
    </div>
</body>
</html>
