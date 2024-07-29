<?php
session_start();
require_once '../base_datos/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y limpia los datos del formulario
    $usuario = trim($_POST["usuario"]);
    $contraseña = trim($_POST["contraseña"]);
    $correo = trim($_POST["correo"]);
    $id_roles = isset($_POST["id_roles"]) ? trim($_POST["id_roles"]) : '';

    // Verifica si los campos están vacíos
    if (empty($usuario) || empty($contraseña) || empty($correo) || empty($id_roles)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Valida el correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Verifica si el rol existe
    $sql_role = "SELECT id_roles FROM roles WHERE id_roles = ?";
    if ($stmt_role = $conn->prepare($sql_role)) {
        $stmt_role->bind_param("i", $id_roles);
        $stmt_role->execute();
        $stmt_role->store_result();

        if ($stmt_role->num_rows > 0) {
            // Verifica si el usuario ya existe
            $sql_user = "SELECT usuario FROM usuarios WHERE usuario = ?";
            if ($stmt_user = $conn->prepare($sql_user)) {
                $stmt_user->bind_param("s", $usuario);
                $stmt_user->execute();
                $stmt_user->store_result();

                if ($stmt_user->num_rows > 0) {
                    echo "El usuario ya existe.";
                } else {
                    // Inserta el nuevo usuario (sin hash para la contraseña)
                    $sql_insert = "INSERT INTO usuarios (usuario, contraseña, correo_electronico, id_roles) VALUES (?, ?, ?, ?)";
                    if ($stmt_insert = $conn->prepare($sql_insert)) {
                        $stmt_insert->bind_param("sssi", $usuario, $contraseña, $correo, $id_roles);
                        if ($stmt_insert->execute()) {
                            // Mostrar mensaje de bienvenida y redirigir
                            echo "
                            <html lang='es'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <title>Registro exitoso</title>
                                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                                <script>
                                    setTimeout(function() {
                                        window.location.href = '../login/login.php';
                                    }, 2000); // Redirige después de 2 segundos
                                </script>
                            </head>
                            <body>
                                <div class='container mt-5'>
                                    <div class='alert alert-success'>
                                        <strong>Registro exitoso!</strong> Bienvenido, $usuario. Serás redirigido a la página de inicio de sesión en 2 segundos.
                                    </div>
                                </div>
                            </body>
                            </html>";
                            exit;
                        } else {
                            echo "Error al registrar el usuario: " . $stmt_insert->error;
                        }
                        $stmt_insert->close();
                    } else {
                        echo "Error en la preparación de la consulta de inserción.";
                    }
                }
                $stmt_user->close();
            } else {
                echo "Error en la preparación de la consulta de usuario: " . $conn->error;
            }
        } else {
            echo "El rol seleccionado no está registrado.";
        }
        $stmt_role->close();
    } else {
        echo "Error en la preparación de la consulta de rol: " . $conn->error;
    }
    $conn->close();
} else {
    header("Location: register.php");
    exit;
}
?>
