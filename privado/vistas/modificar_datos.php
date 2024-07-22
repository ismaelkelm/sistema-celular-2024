<?php
// modificar_datos.php
include_once '../privado/configuracion/bd.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../publico/inicio_sesion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    if (modificarDatosUsuario($_SESSION['usuario'], $nombre, $email)) {
        $mensaje = "Datos actualizados con éxito.";
    } else {
        $mensaje = "No se pudo actualizar los datos.";
    }
}

$perfil = obtenerPerfilUsuario($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Datos</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Modificar Datos</h1>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($perfil['nombre']); ?>" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($perfil['email']); ?>" required>
        <button type="submit">Actualizar</button>
        <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    </form>
</body>
</html>
