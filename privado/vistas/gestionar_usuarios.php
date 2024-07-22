<?php
// gestionar_usuarios.php
include_once '../privado/configuracion/bd.php';
session_start();

if (!isset($_SESSION['usuario']) || !esAdministrador($_SESSION['usuario'])) {
    header('Location: ../publico/inicio_sesion.php');
    exit();
}

$usuarios = obtenerUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <h1>Gestionar Usuarios</h1>
    <table>
        <tr>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['usuario']; ?></td>
            <td><?php echo $usuario['rol']; ?></td>
            <td><a href="editar_usuario.php?usuario=<?php echo $usuario['usuario']; ?>">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
