<?php
session_start();
require_once '../base_datos/db.php'; // Ajusta la ruta según sea necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica el token CSRF
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        header("Location: login.html?error=" . urlencode("Token CSRF inválido."));
        exit;
    }

    // Captura y limpia los datos del formulario
    $usuario = trim($_POST["usuario"]);
    $contraseña = trim($_POST["contraseña"]);

    // Verifica si los campos están vacíos
    if (empty($usuario) || empty($contraseña)) {
        header("Location: login.html?error=" . urlencode("Por favor, complete todos los campos."));
        exit;
    }

    // Consulta para obtener el id, la contraseña hasheada y el rol del usuario
    $sql = "SELECT id_usuarios, contraseña, id_roles FROM usuarios WHERE usuario = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Enlaza el parámetro y ejecuta la consulta
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result(); // Almacena el resultado para contar las filas

        // Verifica si se encontraron resultados
        if ($stmt->num_rows > 0) {
            // Enlaza el resultado y lo obtiene
            $stmt->bind_result($user_id, $hashed_password, $user_role);
            $stmt->fetch();

            // Verifica si la contraseña es correcta
            if (password_verify($contraseña, $hashed_password)) {
                // Establece las variables de sesión
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_role'] = $user_role;

                // Redirige al usuario a la página correspondiente según su rol
                switch ($user_role) {
                    case 1:
                        header("Location: ../administrador/administrador.php");
                        break;
                    case 2:
                        header("Location: ../tecnico/tecnico.php");
                        break;
                    case 3:
                        header("Location: ../administrativo/administrativo.php");
                        break;
                    default:
                        header("Location: ../cliente/cliente.php");
                        break;
                }
                exit;
            } else {
                // Contraseña incorrecta
                header("Location: login.html?error=" . urlencode("Contraseña incorrecta."));
                exit;
            }
        } else {
            // Nombre de usuario no encontrado
            header("Location: login.html?error=" . urlencode("Nombre de usuario no encontrado."));
            exit;
        }
        // Cierra la declaración
        $stmt->close();
    } else {
        // Error en la preparación de la consulta
        header("Location: login.html?error=" . urlencode("Error en la preparación de la consulta."));
        exit;
    }
    // Cierra la conexión
    $conn->close();
} else {
    // Redirige al formulario de inicio de sesión si la solicitud no es POST
    header("Location: login.html");
    exit;
}
?>
