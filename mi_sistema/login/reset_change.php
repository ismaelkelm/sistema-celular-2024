<?php
session_start();
require_once '../base_datos/db.php'; // Ajusta la ruta según sea necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = trim($_POST["token"]);
    $nuevo_usuario = trim($_POST["nuevo_usuario"]);
    $nueva_contraseña = trim($_POST["nueva_contraseña"]);

    if (empty($token) || empty($nuevo_usuario) || empty($nueva_contraseña)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Verifica el token
    $sql = "SELECT user_id, expires FROM password_resets WHERE token = ? AND expires > ?";
    if ($stmt = $conn->prepare($sql)) {
        $current_time = date("U");
        $stmt->bind_param("si", $token, $current_time);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $expires);
            $stmt->fetch();

            // Actualizar el usuario o contraseña
            if (!empty($nuevo_usuario)) {
                $sql_update_user = "UPDATE usuarios SET usuario = ? WHERE id_usuarios = ?";
                if ($stmt_update_user = $conn->prepare($sql_update_user)) {
                    $stmt_update_user->bind_param("si", $nuevo_usuario, $user_id);
                    $stmt_update_user->execute();
                    $stmt_update_user->close();
                } else {
                    echo "Error en la actualización del nombre de usuario.";
                }
            }

            if (!empty($nueva_contraseña)) {
                $hashed_password = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
                $sql_update_password = "UPDATE usuarios SET contraseña = ? WHERE id_usuarios = ?";
                if ($stmt_update_password = $conn->prepare($sql_update_password)) {
                    $stmt_update_password->bind_param("si", $hashed_password, $user_id);
                    $stmt_update_password->execute();
                    $stmt_update_password->close();
                } else {
                    echo "Error en la actualización de la contraseña.";
                }
            }

            // Eliminar el token después del uso
            $sql_delete = "DELETE FROM password_resets WHERE token = ?";
            if ($stmt_delete = $conn->prepare($sql_delete)) {
                $stmt_delete->bind_param("s", $token);
                $stmt_delete->execute();
                $stmt_delete->close();
                echo "Cambio exitoso.";
            } else {
                echo "Error al eliminar el token.";
            }
        } else {
            echo "El token es inválido o ha expirado.";
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta de token.";
    }
    $conn->close();
} else {
    header("Location: reset_change_form.php");
    exit;
}
?>
