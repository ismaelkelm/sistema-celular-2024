<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

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

    // Preparar la consulta SQL para insertar un nuevo usuario
    $query = "INSERT INTO usuarios (usuario, contraseña, correo_electronico, id_roles) VALUES ('$usuario', '$contraseña', '$correo_electronico', '$id_roles')";

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
    <h1 class="mb-4">Agregar Usuario</h1>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
        </div>
        <div class="form-group">
            <label for="id_roles">Rol</label>
            <select class="form-control" id="id_roles" name="id_roles" required>
                <?php while ($row_role = mysqli_fetch_assoc($result_roles)) { ?>
                <option value="<?php echo htmlspecialchars($row_role['id_roles']); ?>">
                    <?php echo htmlspecialchars($row_role['nombre']); ?> <!-- Ajusta el campo según tu tabla de roles -->
                </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
