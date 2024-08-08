<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Consultar roles para el menú desplegable
$query_roles = "SELECT id_roles, nombre FROM roles";
$result_roles = mysqli_query($conn, $query_roles);

// Verificar si la consulta fue exitosa
if (!$result_roles) {
    die("Error en la consulta de roles: " . mysqli_error($conn));
}

// Procesar el formulario de creación si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $contraseña = $_POST['contraseña'];
    $email = $_POST['email'];
    $id_roles = $_POST['id_roles'];

    // Encriptar la contraseña
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta de inserción
    $sql_insert = "INSERT INTO usuarios (nombre, DNI, contraseña, email, id_roles) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt_insert = $conn->prepare($sql_insert)) {
        $stmt_insert->bind_param("ssssi", $nombre, $dni, $hashed_password, $email, $id_roles);
        if ($stmt_insert->execute()) {
            echo "Usuario insertado correctamente: " . htmlspecialchars($nombre) . "<br>";
        } else {
            echo "Error al insertar usuario " . htmlspecialchars($nombre) . ": " . $stmt_insert->error . "<br>";
        }
        $stmt_insert->close();
    } else {
        echo "Error al preparar la consulta de inserción: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Nuevo Usuario</h1>
    <form method="POST" action="create.php">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_roles">Rol</label>
            <select id="id_roles" name="id_roles" class="form-control" required>
                <?php while ($row_role = mysqli_fetch_assoc($result_roles)) { ?>
                    <option value="<?php echo htmlspecialchars($row_role['id_roles']); ?>">
                        <?php echo htmlspecialchars($row_role['nombre']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>
