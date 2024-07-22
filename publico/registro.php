<?php
// registro.php
include_once '../privado/ayudantes/autenticacion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (registrarUsuario($usuario, $password)) {
        header('Location: inicio_sesion.php');
        exit();
    } else {
        $mensaje = "No se pudo registrar el usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registrar</button>
        <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    </form>
</body>
</html>
