<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $contraseña = mysqli_real_escape_string($conn, $_POST['contraseña']);
    $id_roles = mysqli_real_escape_string($conn, $_POST['id_roles']);
    $correo_electronico = mysqli_real_escape_string($conn, $_POST['correo_electronico']);
    $dni = mysqli_real_escape_string($conn, $_POST['dni']);

    // Encriptar la contraseña antes de almacenarla
    $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (nombre, contraseña, id_roles, correo_electronico, dni) VALUES ('$nombre', '$contraseña_encriptada', '$id_roles', '$correo_electronico', '$dni')";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        die("Error al agregar el usuario: " . mysqli_error($conn));
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <h1 class="mb-4">Agregar Usuario</h1>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
        </div>
        <div class="form-group">
            <label for="id_roles">Rol</label>
            <select class="form-control" id="id_roles" name="id_roles" required>
                <?php
                $rolesQuery = "SELECT * FROM roles";
                $rolesResult = mysqli_query($conn, $rolesQuery);
                while ($role = mysqli_fetch_assoc($rolesResult)) {
                    echo "<option value='" . htmlspecialchars($role['id_roles']) . "'>" . htmlspecialchars($role['nombre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
