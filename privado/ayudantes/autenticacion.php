<?php
// autenticacion.php
include_once '../configuracion/bd.php';

function autenticarUsuario($usuario, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT password FROM usuarios WHERE usuario = ?');
    $stmt->execute([$usuario]);
    $hashedPassword = $stmt->fetchColumn();
    return password_verify($password, $hashedPassword);
}

function registrarUsuario($usuario, $password) {
    global $pdo;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare('INSERT INTO usuarios (usuario, password) VALUES (?, ?)');
    return $stmt->execute([$usuario, $passwordHash]);
}

function esAdministrador($usuario) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT rol FROM usuarios WHERE usuario = ?');
    $stmt->execute([$usuario]);
    return $stmt->fetchColumn() === 'admin';
}
