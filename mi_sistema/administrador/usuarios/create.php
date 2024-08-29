<?php
include '../../base_datos/db.php'; // Incluye el archivo de conexión

// Consultar roles para el desplegable
$rolesQuery = "SELECT * FROM roles";
$rolesResult = mysqli_query($conn, $rolesQuery);

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo_electronico = $_POST['correo_electronico'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Hash de la contraseña
    $id_roles = $_POST['id_roles'];

    // Insertar nuevo usuario
    $query = "INSERT INTO usuarios (nombre, apellido, correo_electronico, contraseña, id_roles) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nombre, $apellido, $correo_electronico, $contraseña, $id_roles);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirigir a la lista de usuarios
        exit();
    } else {
        die("Error al insertar: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Agregar Usuario</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="correo_electronico" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
        </div>
        <div class="mb-3">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
        </div>
        <div class="mb-3">
            <label for="id_roles" class="form-label">Rol</label>
            <select id="id_roles" name="id_roles" class="form-select" required>
                <?php while ($role = mysqli_fetch_assoc($rolesResult)) { ?>
                <option value="<?php echo htmlspecialchars($role['id_roles']); ?>">
                    <?php echo htmlspecialchars($role['descripcion']); ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
</body>
</html>
