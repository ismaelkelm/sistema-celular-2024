<?php
session_start();
require_once '../base_datos/db.php'; // Ajusta la ruta según sea necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = trim($_POST["token"]);
    $nuevo_valor = trim($_POST["nuevo_valor"]);

    if (empty($token) || empty($nuevo_valor)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Verificar el token
    $sql = "SELECT user_id, tipo_cambio FROM password_resets WHERE token = ? AND expires > ?";
    if ($stmt = $conn->prepare($sql)) {
        $current_time = date("U");
        $stmt->bind_param("si", $token, $current_time);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $tipo_cambio);
            $stmt->fetch();

            // Actualizar el nombre de usuario o la contraseña
            if ($tipo_cambio == 'usuario') {
                $sql_update = "UPDATE usuarios SET usuario = ? WHERE id_usuarios = ?";
            } else {
                $sql_update = "UPDATE usuarios SET contraseña = ? WHERE id_usuarios = ?";
                $nuevo_valor = password_hash($nuevo_valor, PASSWORD_DEFAULT);
            }

            if ($stmt_update = $conn->prepare($sql_update)) {
                $stmt_update->bind_param($tipo_cambio == 'usuario' ? "si" : "si", $nuevo_valor, $user_id);
                $stmt_update->execute();

                // Eliminar el token después de usarlo
                $sql_delete = "DELETE FROM password_resets WHERE token = ?";
                if ($stmt_delete = $conn->prepare($sql_delete)) {
                    $stmt_delete->bind_param("s", $token);
                    $stmt_delete->execute();
                    echo "El " . ($tipo_cambio == 'usuario' ? "nombre de usuario" : "contraseña") . " ha sido actualizado exitosamente.";
                } else {
                    echo "Error al eliminar el token.";
                }
            } else {
                echo "Error en la preparación de la consulta de actualización.";
            }
        } else {
            echo "El enlace de recuperación es inválido o ha expirado.";
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta de token.";
    }
    $conn->close();
} else {
    header("Location: forgot_change.html");
    exit;
}
?>
