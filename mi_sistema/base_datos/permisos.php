<?php
require_once '../../mi_sistema/base_datos/db.php';

// Capturar el ID del usuario desde el formulario
if (!isset($_POST['rol_id'])) {
    die('ID de usuario no proporcionado.');
}

$user_id = $_POST['rol_id'];

// Obtener el rol del usuario desde la base de datos
$query = "SELECT r.nombre, r.id_roles FROM usuarios u JOIN roles r ON u.id_roles = r.id_roles WHERE u.id_usuarios = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role_name = $row['nombre'];
$role_id = $row['id_roles'];
$stmt->close();

// Obtener los permisos del rol desde la base de datos
$query = "
    SELECT p.descripcion, pr.estado, p.idPermisos
    FROM permisos_en_roles pr
    JOIN permisos p ON pr.permisos_idPermisos = p.idPermisos
    WHERE pr.roles_id_roles = ?
";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();

$permisos_del_usuario = array();
while ($row = $result->fetch_assoc()) {
    $permisos_del_usuario[] = array(
        'descripcion' => $row['descripcion'],
        'estado' => $row['estado'],
        'idPermisos' => $row['idPermisos']
    );
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permisos en roles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function cambiarEstado(rolId, permisoId, estado) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./actualizar_permisos.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send("roles_id_roles=" + rolId + "&Permisos_idPermisos=" + permisoId + "&estado=" + estado);
        }
    </script>
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Permisos del '<?php echo htmlspecialchars($role_name); ?>'</h2>
        <ul class="list-group">
            <?php foreach ($permisos_del_usuario as $permiso): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong><?php echo htmlspecialchars($permiso['descripcion']); ?></strong>
                    <button class="btn btn-<?php echo $permiso['estado'] ? 'success' : 'danger'; ?>" onclick="cambiarEstado(<?php echo $role_id; ?>, <?php echo $permiso['idPermisos']; ?>, <?php echo $permiso['estado'] ? 0 : 1; ?>)">
                        <?php echo $permiso['estado'] ? 'Permitido' : 'No permitido'; ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div> <a href="http://"></a>
    <a href="./gestionar_permisos.php "><button type="button" class="btn btn-secondary">Volver a Permisos</button></a>
</body>
</html>
