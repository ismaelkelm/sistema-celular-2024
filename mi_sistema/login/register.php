<?php
session_start();
require_once '../base_datos/db.php';

// Generar un token CSRF para el formulario
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Consultar los roles desde la base de datos
$sql_roles = "SELECT id_roles, nombre FROM roles";
$roles = [];
if ($stmt_roles = $conn->prepare($sql_roles)) {
    $stmt_roles->execute();
    $stmt_roles->bind_result($id_roles, $nombre);
    while ($stmt_roles->fetch()) {
        $roles[] = ['id_roles' => $id_roles, 'nombre' => $nombre];
    }
    $stmt_roles->close();
} else {
    echo "Error al consultar los roles: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Registro de Usuario</h2>
        <form action="register_process.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

            <div class="form-group">
                <label for="id_roles">Rol</label>
                <select class="form-control" id="id_roles" name="id_roles" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo htmlspecialchars($role['id_roles']); ?>">
                            <?php echo htmlspecialchars($role['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="usuario">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" required>
            </div>

            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="../login/login.html" class="btn btn-secondary">Volver atrás</a>
        </form>

        <p class="mt-3">¿Ya tienes una cuenta? <a href="../login/login.html">Inicia sesión aquí.</a></p>
    </div>
</body>
</html>
