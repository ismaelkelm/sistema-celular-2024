<?php
// Conectar a la base de datos
function dbConnect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "marquez";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

// Obtener el estado de la orden
function getOrderStatus($orderNumber) {
    $conn = dbConnect();
    $sql = "SELECT estado FROM pedidos_de_reparación WHERE numero_de_orden = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $orderNumber); // 's' para string, ya que numero_de_orden es una cadena
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $statusText = $row['estado'];
        $statusClass = ($statusText == 'Completada') ? 'alert-success' : 'alert-warning';
        $stmt->close();
        $conn->close();
        return ['text' => $statusText, 'class' => $statusClass];
    } else {
        $stmt->close();
        $conn->close();
        return ['text' => 'No se encontró la orden', 'class' => 'alert-danger'];
    }
}
?>
<?php
// Definir el rol predeterminado (puedes cambiar esto a cualquier rol que desees simular)
$defaultRole = 'Administrativo';

// Cargar permisos
function getUserPermissions($role) {
    $permissions = include 'base_datos/permisos.php'; // Ajusta la ruta según tu estructura
    return isset($permissions[$role]) ? $permissions[$role] : [];
}

// Verificar acceso a una sección
function canAccess($section) {
    global $defaultRole; // Usar el rol predeterminado
    $permissions = getUserPermissions($defaultRole);
    return isset($permissions[$section]) && $permissions[$section] == 'on';
}

// Mostrar secciones basadas en permisos
function showSection($sectionName) {
    if (canAccess($sectionName)) {
        echo "<div class='section'>$sectionName</div>";
    } else {
        echo "<div class='section'>No tienes permiso para acceder a esta sección.</div>";
    }
}
?>
