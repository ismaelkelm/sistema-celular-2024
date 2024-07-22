<?php
// inicio_sesion.php
include_once '../privado/ayudantes/autenticacion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (autenticarUsuario($usuario, $password)) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('Location: perfil_cliente.php');
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
        <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    </form>
</body>
</html>
