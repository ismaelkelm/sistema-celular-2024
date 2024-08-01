<?php

session_start();

// Incluir el archivo de conexión
require '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples

// Verificar si el usuario ha iniciado sesión
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../index.php");
//     exit;
// }

// Supongamos que el ID del usuario está almacenado en $_SESSION['user_id']
$user_id = $_SESSION['user_id'];

// Consultar el id_roles del usuario
$query = "SELECT id_roles FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error en la consulta: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$id_roles = $row['id_roles'];

// Verificar si el usuario es técnico
require_once '../base_datos/roles.php'; // Usar require_once para evitar inclusiones múltiples
// if ($roles[$id_roles]['name'] !== 'Técnico') {
//     header("Location: ../index.php");
//     exit;
// }

// Incluir el header.php para el contenido compartido
$pageTitle = "Técnico - Mi Empresa"; // Establecer el título específico para esta página
include('../includes/header.php'); 
?>

<!-- Contenido principal -->
<div id="content-container" class="container my-4">
    <h2 class="text-center">Panel de Técnico</h2>
    <div class="row">
        <?php foreach ($roles[$id_roles]['permissions'] as $permission): ?>
            <div class="col-md-2 mb-4">
                <a href="<?php echo strtolower(str_replace(' ', '_', $permission)); ?>/index.php" class="btn btn-light p-3 d-block text-center">
                    <i class="fas fa-<?php echo getIconClass($permission); ?> fa-3x"></i>
                    <p class="mt-2"><?php echo ucfirst($permission); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="text-center py-4">
    <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
function getIconClass($permission) {
    $icons = [
        'Accesorios' => 'box',
        'Clientes' => 'users',
        'Detalle Facturas' => 'file-invoice',
        'Detalle Reparaciones' => 'tools',
        'Dispositivos' => 'mobile-alt',
        'Empleados' => 'user-tie',
        'Facturas' => 'file-invoice-dollar',
        'Notificaciones' => 'bell',
        'Pagos' => 'money-bill-wave',
        'Pedidos de Reparación' => 'box-open',
        'Piezas y Componentes' => 'cogs',
        'Proveedores' => 'truck',
        'Recibos' => 'receipt',
        'Reparaciones' => 'wrench',
        'Roles' => 'user-shield',
        'Técnicos' => 'user-cog',
        'Tickets' => 'ticket-alt',
        'Usuarios' => 'users-cog',
        'Ventas Accesorios' => 'shopping-cart'
    ];
    return $icons[$permission] ?? 'question-circle';
}
?>
