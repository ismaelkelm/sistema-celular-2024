<?php
// funciones_adicionales.php
include_once '../configuracion/bd.php';

function obtenerHistorialReparaciones($usuario) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT numero_orden, descripcion, estado FROM reparaciones WHERE cliente = ?');
    $stmt->execute([$usuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function realizarPago($numeroOrden, $monto) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO pagos (numero_orden, monto) VALUES (?, ?)');
    return $stmt->execute([$numeroOrden, $monto]);
}

function generarFactura($numeroOrden) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM facturas WHERE numero_orden = ?');
    $stmt->execute([$numeroOrden]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerReparacionesPendientes() {
    global $pdo;
    $stmt = $pdo->query('SELECT descripcion FROM reparaciones WHERE estado = "Pendiente"');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerPedidosPendientes() {
    global $pdo;
    $stmt = $pdo->query('SELECT descripcion FROM pedidos WHERE estado = "Pendiente"');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerInventario() {
    global $pdo;
    $stmt = $pdo->query('SELECT nombre, stock, precio FROM accesorios');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerUsuarios() {
    global $pdo;
    $stmt = $pdo->query('SELECT usuario, rol FROM usuarios');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
