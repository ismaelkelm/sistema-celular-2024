<?php
session_start();
require_once '../base_datos/db.php'; // Ajusta la ruta según la ubicación de db.php

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $role_id = trim($_POST["role"]);

    // Verificar que los campos no estén vacíos
    if (empty($username) || empty($password) || empty($role_id)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Verificar que el rol administrador no esté registrado si se está intentando registrar como administrador
    $admin_role_id = 1; // Suponiendo que el rol administrador tiene ID 1
    $sql = "SELECT COUNT(*) FROM usuarios WHERE rol_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $admin_role_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        
        // Si el rol administrador ya está registrado, filtrar los roles disponibles
        if ($count > 0 && $role_id == $admin_role_id) {
            echo "El rol administrador ya está registrado. Por favor, selecciona otro rol.";
            exit;
        }
        
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta.";
        exit;
    }

    // Verificar si el usuario ya existe
    $sql = "SELECT id FROM usuarios WHERE nombre = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        // Si el usuario ya existe
        if ($stmt->num_rows > 0) {
            echo "Ya existe un usuario con ese nombre.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombre, contraseña, rol_id) VALUES (?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssi", $username, $hashed_password, $role_id);
                if ($stmt->execute()) {
                    echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
                } else {
                    echo "Error al registrar el usuario.";
                }
                $stmt->close();
            } else {
                echo "Error en la preparación de la consulta.";
            }
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta.";
    }
    $conn->close();
} else {
    // Si no se envió el formulario, redirigir al formulario de registro
    header("Location: register.php");
    exit;
}
?>
