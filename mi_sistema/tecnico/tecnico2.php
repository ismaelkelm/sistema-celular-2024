<?php
// Iniciar sesión si no se ha iniciado ya
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir el archivo de conexión
require_once '../base_datos/db.php'; // Asegúrate de que este archivo defina y exporte $conn

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

// Supongamos que el ID del usuario está almacenado en $_SESSION['user_id']
$user_id = $_SESSION['user_id'];

// Consultar el id_roles del usuario
$query = "SELECT id_roles FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Error: Usuario no encontrado.");
}

$id_roles = $row['id_roles'];

// Consultar el nombre del rol directamente desde la base de datos
$query = "SELECT nombre FROM roles WHERE id_roles = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $id_roles);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Error: Rol no encontrado.");
}

$role_name = $row['nombre'];

// Verificar si el usuario tiene el rol 'tecnico'
if ($role_name !== 'tecnico') {
    header("Location: ../login/login.php");
    exit;
}

// Consultar el ID del técnico asociado al usuario
$query = "SELECT id_tecnicos FROM tecnicos WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Error: Técnico no encontrado.");
}

$id_tecnico = $row['id_tecnicos'];

// Incluir los archivos comunes
$pageTitle = "Panel de Control - Tecnico"; // Establecer el título específico para esta página
include('../includes/header.php'); // Asegúrate de que header.php no incluya nav.php nuevamente
include('../base_datos/icons.php'); // Incluir los iconos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome para iconos -->
    <style>
        .card-icon {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            background-color: #f9f9f9;
        }
        .card-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-icon i {
            color: #007bff;
            font-size: 2rem; /* Ajusta el tamaño del icono aquí */
            transition: color 0.3s ease;
        }
        .card-icon:hover i {
            color: #dc3545; /* Cambia el color al pasar el ratón */
        }
        .card-icon .card-body {
            padding: 1.5rem;
        }
        .card-title {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <!-- Incluye el menú de navegación aquí solo una vez -->
    <?php include('../includes/nav.php'); ?>

    <div class="container my-4">
        <h2 class="mb-4">Panel de Control - Tecnico</h2>
        <div class="row">
            <?php foreach ($iconos_visibles as $tabla => $icono): ?>
                <div class="col-md-3 mb-4">
                    <div class="card card-icon text-center">
                        <div class="card-body">
                            <a href="<?php echo htmlspecialchars($icono['ruta']); ?>">
                                <i class="fas <?php echo htmlspecialchars($icono['icono']); ?>"></i>
                                <h5 class="card-title mt-3"><?php echo htmlspecialchars(ucfirst($tabla)); ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>