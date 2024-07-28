<?php
session_start();
require_once '../base_datos/db.php'; // Ajusta la ruta según sea necesario

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token
    $sql = "SELECT user_id, expires FROM password_resets WHERE token = ? AND expires > ?";
    if ($stmt = $conn->prepare($sql)) {
        $current_time = date("U");
        $stmt->bind_param("si", $token, $current_time);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $expires);
            $stmt->fetch();

            // Mostrar formulario para establecer nueva contraseña
            echo '<form action="reset_password_process.php" method="POST">
                    <input type="hidden" name="token" value="' . $token . '">
                    <div class="form-group">
                        <label for="contraseña">Nueva Contraseña:</label>
                        <input type="password" id="contraseña" name="contraseña" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                  </form>';
        } else {
            echo "El enlace de recuperación es inválido o ha expirado.";
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta de token.";
    }
    $conn->close();
} else {
    header("Location: forgot_password.html");
    exit;
}
?>
