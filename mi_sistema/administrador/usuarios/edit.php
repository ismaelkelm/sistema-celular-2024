<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Obtener el ID del usuario a editar
$id = $_GET['id'];

// Consultar el usuario específico
$query = "SELECT * FROM usuarios WHERE id_usuarios = '$id'";
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// Obtener los datos del usuario
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Usuario no encontrado");
}

// Consultar roles para el menú desplegable
$query_roles = "SELECT * FROM roles"; // Asegúrate de que esta tabla y consulta existan
$result_roles = mysqli_query($conn, $query_roles);

// Verificar si la consulta de roles fue exitosa
if (!$result_roles) {
    die("Error en la consulta de roles: " . mysqli_error($conn));
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contraseña = mysqli_real_escape_string($conn, $_POST['contraseña']);
    $correo_electronico = mysqli_real_escape_string($conn, $_POST['correo_electronico']);
    $id_roles = mysqli_real_escape_string($conn, $_POST['id_roles']);

    // Preparar la consulta SQL para actualizar el usuario
    $query = "UPDATE usuarios SET usuario='$usuario', contraseña='$contraseña', correo_electronico='$correo_electronico', id_roles='$id_roles' WHERE id_usuarios='$id'";

    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($conn, $query)) {
        header("Location: index.php"); // Redirigir a la página principal de la lista
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Mostrar mensaje de error
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
    <h1 class="mb-4">Editar Usuario</h1>
    <form action="edit.php?id=<?php echo htmlspecialchars($row['id_usuarios']); ?>" method="post">
        <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo htmlspecialchars($row['usuario']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" value="<?php echo htmlspecialchars($row['contraseña']); ?>" required>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo htmlspecialchars($row['correo_electronico']); ?>" required>
        </div>
        <div class="form-group">
            <label for="id_roles">Rol</label>
            <select class="form-control" id="id_roles" name="id_roles" required>
                <?php while ($row_role = mysqli_fetch_assoc($result_roles)) { ?>
                <option value="<?php echo htmlspecialchars($row_role['id_roles']); ?>" <?php echo $row['id_roles'] == $row_role['id_roles'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row_role['nombre']); ?> <!-- Ajusta el campo según tu tabla de roles -->
                </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
