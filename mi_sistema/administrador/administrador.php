<?php
session_start();

// Incluir el archivo de conexión
require_once '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

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

// Verificar si el usuario es administrador
require_once '../base_datos/roles.php'; // Usar require_once para evitar inclusiones múltiples
if ($roles[$id_roles]['name'] !== 'Administrador') {
    header("Location: ../index.php");
    exit;
}

// Incluir el header.php para el contenido compartido
$pageTitle = "Administrador - Mi Empresa"; // Establecer el título específico para esta página
include('../includes/header.php'); 
?>

<!-- Contenido principal -->
<div id="content-container" class="container my-4">
    <h2 class="text-center">Panel de Administrador</h2>
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
        'Accesorios' => 'box', // Se usa 'box' para accesorios
        'Clientes' => 'users', // Se usa 'users' para clientes
        'Detalle Facturas' => 'file-invoice', // Se usa 'file-invoice' para detalle de facturas
        'Detalle Reparaciones' => 'tools', // Se usa 'tools' para detalle de reparaciones
        'Dispositivos' => 'mobile-alt', // Se usa 'mobile-alt' para dispositivos
        'Empleados' => 'user-tie', // Se usa 'user-tie' para empleados
        'Facturas' => 'file-invoice-dollar', // Se usa 'file-invoice-dollar' para facturas
        'Notificaciones' => 'bell', // Se usa 'bell' para notificaciones
        'Pagos' => 'money-bill-wave', // Se usa 'money-bill-wave' para pagos
        'Pedidos de Reparación' => 'box-open', // Se usa 'box-open' para pedidos de reparación
        'Piezas y Componentes' => 'cogs', // Se usa 'cogs' para piezas y componentes
        'Proveedores' => 'truck', // Se usa 'truck' para proveedores
        'Recibos' => 'receipt', // Se usa 'receipt' para recibos
        'Reparaciones' => 'wrench', // Se usa 'wrench' para reparaciones
        'Roles' => 'user-shield', // Se usa 'user-shield' para roles
        'Técnicos' => 'user-cog', // Se usa 'user-cog' para técnicos
        'Tickets' => 'ticket-alt', // Se usa 'ticket-alt' para tickets
        'Usuarios' => 'users-cog', // Se usa 'users-cog' para usuarios
        'Ventas Accesorios' => 'shopping-cart', // Se usa 'shopping-cart' para ventas accesorios
        'Movimientos' => 'sync', // Se usa 'sync' para movimientos
        'Movimientos Financieros' => 'credit-card', // Se usa 'credit-card' para movimientos financieros
        'Password Resets' => 'lock' // Se usa 'lock' para resets de contraseña
    ];
    return $icons[$permission] ?? 'question-circle';
}
?>
