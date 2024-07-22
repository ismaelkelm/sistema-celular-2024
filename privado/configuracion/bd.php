<?php
// bd.php
$dsn = 'mysql:host=localhost;dbname=sistema_celular_2024';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

function obtenerEstadoReparacion($numeroOrden) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT estado FROM reparaciones WHERE numero_orden = ?');
    $stmt->execute([$numeroOrden]);
    return $stmt->fetchColumn();
}

function verificarPago($numeroOrden) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT pagado FROM pagos WHERE numero_orden = ?');
    $stmt->execute([$numeroOrden]);
    return $stmt->fetchColumn();
}

function obtenerListaPedidos() {
    global $pdo;
    $stmt = $pdo->query('SELECT numero_orden, cliente, estado FROM pedidos');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerPerfilUsuario($usuario) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT nombre, email FROM usuarios WHERE usuario = ?');
    $stmt->execute([$usuario]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerDetallesPedido($numeroOrden) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT numero_orden, cliente, descripcion FROM pedidos WHERE numero_orden = ?');
    $stmt->execute([$numeroOrden]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function registrarUsuario($usuario, $password) {
    global $pdo;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare('INSERT INTO usuarios (usuario, password) VALUES (?, ?)');
    return $stmt->execute([$usuario, $passwordHash]);
}

function autenticarUsuario($usuario, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT password FROM usuarios WHERE usuario = ?');
    $stmt->execute([$usuario]);
    $hashedPassword = $stmt->fetchColumn();
    return password_verify($password, $hashedPassword);
}
