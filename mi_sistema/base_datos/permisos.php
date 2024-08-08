<?php
require_once '../../mi_sistema/base_datos/db.php';

// Capturar el ID del rol desde el formulario
if (!isset($_POST['rol_id'])) {
    die('ID de rol no proporcionado.');
}

$role_id = $_POST['rol_id'];

// Obtener el nombre del rol desde la base de datos
$query = "SELECT nombre FROM roles WHERE id_roles = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role_name = $row['nombre'];
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

$permisos_del_rol = array();
while ($row = $result->fetch_assoc()) {
    $permisos_del_rol[] = array(
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
    <title>Permisos del Rol</title>
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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 2rem;
        }
        .list-group-item {
            border-radius: 0.25rem;
        }
        .btn-back {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="btn btn-secondary btn-back">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h2 class="text-center mb-4">Permisos del Rol '<?php echo htmlspecialchars($role_name); ?>'</h2>
        <ul class="list-group">
            <?php foreach ($permisos_del_rol as $permiso): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong><?php echo htmlspecialchars($permiso['descripcion']); ?></strong>
                    <button class="btn btn-<?php echo $permiso['estado'] ? 'success' : 'danger'; ?>" onclick="cambiarEstado(<?php echo $role_id; ?>, <?php echo $permiso['idPermisos']; ?>, <?php echo $permiso['estado'] ? 0 : 1; ?>)">
                        <?php echo $permiso['estado'] ? 'Permitido' : 'No permitido'; ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
