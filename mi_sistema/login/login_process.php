<?php
session_start();
require_once '../../mi_sistema/base_datos/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y limpia los datos del formulario
    $usuario = trim($_POST["usuario"]);
    $contraseña = trim($_POST["contraseña"]);

    // Verifica si los campos están vacíos
    if (empty($usuario) || empty($contraseña)) {
        header("Location: ../login/login.php?error=" . urlencode("Por favor, complete todos los campos."));
        exit;
    }

    // Verifica si el usuario existe
    $sql_user = "SELECT id_usuarios, contraseña, id_roles FROM usuarios WHERE nombre = ?";
    if ($stmt_user = $conn->prepare($sql_user)) {
        $stmt_user->bind_param("s", $usuario);
        $stmt_user->execute();
        $stmt_user->store_result();
        
        if ($stmt_user->num_rows > 0) {
            $stmt_user->bind_result($id_usuarios, $hashed_password, $id_roles);
            $stmt_user->fetch();

            // Verifica la contraseña
            if (password_verify($contraseña, $hashed_password)) {
                // Inicia la sesión del usuario
                $_SESSION['user_id'] = $id_usuarios;
                $_SESSION['role'] = $id_roles; // Guardar el rol del usuario

                // Verificar si el rol es 'tecnico'
                if ($id_roles == 3) {
                    // Consultar el ID del técnico asociado al usuario
                    $sql_tecnico = "SELECT id_tecnicos FROM tecnicos WHERE id_usuario = ?";
                    if ($stmt_tecnico = $conn->prepare($sql_tecnico)) {
                        $stmt_tecnico->bind_param("i", $id_usuarios);
                        $stmt_tecnico->execute();
                        $stmt_tecnico->store_result();

                        if ($stmt_tecnico->num_rows > 0) {
                            $stmt_tecnico->bind_result($id_tecnico);
                            $stmt_tecnico->fetch();

                            // Redirigir al panel específico del técnico
                            header("Location: ../tecnico/tecnico_panel.php?id_tecnico=" . urlencode($id_tecnico));
                            exit;
                        } else {
                            header("Location: ../login/login.php?error=" . urlencode("ID de técnico no encontrado."));
                            exit;
                        }
                    } else {
                        header("Location: ../login/login.php?error=" . urlencode("Error en la preparación de la consulta de técnico."));
                        exit;
                    }
                } else {
                    // Redirigir según el rol
                    switch ($id_roles) {
                        case 1:
                            header("Location: ../administrador/administrador.php");
                            break;
                        case 2:
                            header("Location: ../administrativo/administrativo.php");
                            break;
                        case 4:
                            header("Location: ../cliente/cliente.php");
                            break;
                        case 5:
                            header("Location: ../empleados/empleado.php");
                            break;
                        default:
                            header("Location: ../login/login.php?error=" . urlencode("Rol de usuario no reconocido."));
                            break;
                    }
                    exit;
                }
            } else {
                header("Location: ../login/login.php?error=" . urlencode("Contraseña incorrecta."));
                exit;
            }
        } else {
            header("Location: ../login/login.php?error=" . urlencode("Nombre de usuario no encontrado."));
            exit;
        }
        $stmt_user->close();
    } else {
        header("Location: ../login/login.php?error=" . urlencode("Error en la preparación de la consulta de usuario."));
        exit;
    }
    $conn->close();
} else {
    // header("Location: ../login/login.php");
    // exit;
}
?>
