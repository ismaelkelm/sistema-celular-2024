<?php
session_start();
require_once '../base_datos/db.php'; // Ajusta esta ruta según la ubicación de db.php

// Consultar la base de datos para obtener los roles disponibles
$admin_role_id = 1; // Suponiendo que el rol administrador tiene ID 1
$sql = "SELECT id, nombre FROM roles WHERE id != ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $admin_role_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $roles = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta.";
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
    <div class="container">
        <h2 class="my-4">Registro de Usuario</h2>
        <form action="register_process.php" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= htmlspecialchars($role['id']) ?>"><?= htmlspecialchars($role['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
