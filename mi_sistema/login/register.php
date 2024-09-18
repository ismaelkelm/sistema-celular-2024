<?php
session_start();
require_once '../base_datos/db.php';
if (!$conn) {
    die("Error de conexión: " . $conn->connect_error);
}

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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="/mi_sistema/estilos/login.css">
</head>

<body>
    <?php
    $message = $message_type = '';  // Inicializar variables

    if (isset($message)): ?>
        <div class="message-container <?php echo htmlspecialchars($message_type); ?>">
            <p><?php echo htmlspecialchars($message); ?></p>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <form action="register_process.php" method="post">

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

            <label for="nombre">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de Usuario" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>

            <label for="correo">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>



            <!-- Botones centrados sin texto -->
            <div class="d-flex justify-content-center mt-3">
                <!-- Botón de volver atrás -->
                <button type="button" class="btn btn-secondary mx-2" onclick="window.location.href='../login/login.php';">
                    <i class="bi bi-skip-backward"></i>
                </button>

                <!-- Botón de registrar -->
                <button type="submit" class="btn btn-primary mx-2">
                    <i class="bi bi-floppy"></i>
                </button>
                <button type="button" class="btn btn-secondary mx-2 " onclick="window.location.href='../index.php';">
                    <i class="bi bi-house"></i>
                </button>
            </div>
        </form>
        <!-- <p class="mt-3">¿Ya tienes una cuenta? <a href="../login/login.php">Inicia sesión aquí.</a></p> -->
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>