<?php
session_start();

// Incluir el archivo de conexión
require_once '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Obtener el ID del usuario desde la sesión
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

// Verificar si el usuario tiene el rol de Cliente
require_once '../base_datos/roles.php'; // Usar require_once para evitar inclusiones múltiples
if ($roles[$id_roles]['name'] !== 'Cliente') {
    header("Location: ../index.php");
    exit;
}

// Incluir el header.php para el contenido compartido
$pageTitle = "Cliente - Mi Empresa"; // Establecer el título específico para esta página
include('../includes/header.php'); 
?>

<!-- Contenido principal -->
<div id="content-container" class="container my-4">
    <h2 class="text-center">Bienvenido, Cliente</h2>
    <p class="text-center">Consulta el estado de tu reparación ingresando el número de orden.</p>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="check_status.php" method="POST">
                <div class="form-group">
                    <label for="orderNumber">Número de Orden:</label>
                    <input type="text" id="orderNumber" name="order_number" class="form-control" placeholder="Ingrese su número de orden" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Consultar Estado</button>
            </form>
        </div>
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
