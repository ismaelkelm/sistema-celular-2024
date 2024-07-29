<?php
session_start();
require_once '../base_datos/db.php'; // Asegúrate de que la ruta sea correcta

// Verificar el token CSRF
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header("Location: login.php?error=" . urlencode("Token CSRF inválido."));
        exit;
    }

    $usuario = trim($_POST["usuario"]);
    $contraseña = trim($_POST["contraseña"]);

    if (empty($usuario) || empty($contraseña)) {
        header("Location: login.php?error=" . urlencode("Por favor, complete todos los campos."));
        exit;
    }

    $sql = "SELECT id_usuarios, contraseña, id_roles FROM usuarios WHERE usuario = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $stored_password, $user_role);
            $stmt->fetch();

            // Comparar la contraseña usando password_verify en producción
            if ($contraseña === $stored_password) {  
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role_id'] = $user_role;

                header("Location: ../index.php");
                exit;
            } else {
                header("Location: login.php?error=" . urlencode("Contraseña incorrecta."));
                exit;
            }
        } else {
            header("Location: login.php?error=" . urlencode("Nombre de usuario no encontrado."));
            exit;
        }
        $stmt->close();
    } else {
        header("Location: login.php?error=" . urlencode("Error en la preparación de la consulta."));
        exit;
    }
    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
?>
