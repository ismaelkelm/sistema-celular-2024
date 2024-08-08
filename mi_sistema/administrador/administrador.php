<?php
// Incluir los archivos necesarios
require_once '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples
require_once '../base_datos/roles.php'; // Usar require_once para evitar inclusiones múltiples
require_once '../base_datos/functions.php'; // Incluir funciones para obtener iconos y rutas

<<<<<<< HEAD
// Obtener los permisos del rol del usuario
$rolePermissions = include('../base_datos/roles.php');
$userRole = 'Administrador'; // Ejemplo de rol; en una aplicación real, esto se obtendría del login o sesión
$permissions = $rolePermissions[$userRole] ?? [];
=======
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

// if (!isset($_SESSION['user_id'])) { controlar que el atributo del rol sea 1 para este modiulo

//     header("Location: ../login/login.php");
//     exit;
// }

// Supongamos que el ID del usuario está almacenado en $_SESSION['user_id']
$user_id = $_SESSION['user_id'];

// Consultar el rol del usuario
$query = "SELECT id_roles FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No se encontró el rol para el usuario.");
}

$row = $result->fetch_assoc();
$id_roles = $row['id_roles'];

// Verificar el rol del usuario
$role_name = '';
foreach ($roles as $role => $permissions) {
    if ($id_roles == array_search($role, array_keys($roles))) {
        $role_name = $role;
        break;
    }
}

if (empty($role_name) || !isset($roles[$role_name])) {
    header("Location: ../login/login.php");
    exit;
}

// Incluir el header.php para el contenido compartido
$pageTitle = "Administrativo - Mi Empresa"; // Establecer el título específico para esta página
include('../includes/header.php');
include_once('../base_datos/functions.php');
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc

$pageTitle = "Administrador - Mi Empresa"; // Establecer el título específico para esta página
include('../includes/header.php');
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
        /* Estilo general */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        #content-container {
            background-color: skyblue;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            max-width: 100%; /* Usar el 100% del ancho disponible */
            width: 90%; /* Ajustar el ancho máximo del contenedor */
        }

        /* Título */
        h2 {
            color: #333333;
            font-weight: 300;
            margin-bottom: 2rem;
        }

        /* Estilo para los iconos */
        .icon-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .icon-item {
            background-color: #ffffff;
            border-radius: 8px;
            margin: 1rem;
            padding: 1rem; /* Reducir el padding para iconos más pequeños */
            width: 150px; /* Reducir el ancho de los iconos */
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        .icon-item:hover {
            background-color: green;
            color: #ffffff;
            transform: scale(1.05);
            cursor: pointer;
        }

        .icon-item i {
            font-size: 2rem; /* Reducir el tamaño de los iconos */
            margin-bottom: 0.75rem;
        }

        .icon-item p {
            margin: 0;
            font-size: 1rem;
        }

        /* Estilo para el footer */
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            #content-container {
                padding: 1rem;
                margin: 1rem auto;
                width: 95%;
            }

            .icon-item {
                width: 120px; /* Reducir el ancho de los iconos en pantallas pequeñas */
            }

            .icon-item i {
                font-size: 1.5rem; /* Reducir el tamaño de los iconos en pantallas pequeñas */
            }

            .icon-item p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div id="content-container" class="container-fluid">
        <h2 class="text-center">Panel de Administrador</h2>

        <!-- Sección de iconos -->
        <div class="icon-grid">
            <?php foreach ($permissions as $permission => $status): ?>
                <?php if ($status === 'on'): ?>
                    <?php
                    $route = getPermissionRoute($permission, $userRole); // Pasar el rol del usuario a la función
                    ?>
                    <a href="<?php echo htmlspecialchars($route); ?>" class="icon-item">
                        <i class="fas fa-<?php echo getIconClass($permission); ?>"></i>
                        <p><?php echo htmlspecialchars($permission); ?></p>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Incluir el footer -->
    <?php include('../includes/footer.php'); ?>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
