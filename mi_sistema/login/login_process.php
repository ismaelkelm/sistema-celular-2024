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
                // Verifica si el rol existe
                $sql_role = "SELECT nombre FROM roles WHERE id_roles = ?";
                if ($stmt_role = $conn->prepare($sql_role)) {
                    $stmt_role->bind_param("i", $id_roles);
                    $stmt_role->execute();
                    $stmt_role->store_result();

                    if ($stmt_role->num_rows > 0) {
                        $stmt_role->bind_result($role_name);
                        $stmt_role->fetch();
                        
                        // Inicia la sesión del usuario
                        $_SESSION['user_id'] = $id_usuarios;
                        $_SESSION['role'] = $role_name;

                        // Redirige al usuario según su rol
                        switch ($role_name) {
                            case 'administrador':
                                header("Location: ../administrador/administrador.php");
                                break;
                            case 'administrativo':
                                header("Location: ../administrativo/administrativo.php");
                                break;
                            case 'tecnico':
                                header("Location: ../tecnico/tecnico.php");
                                break;
                            case 'cliente':
                                header("Location: ../cliente/cliente.php");
                                break;        
                            case 'empleado':
                                header("Location: ../empleado/empleado.php");
                                break;    
                            
                            default:
                                header("Location: ../login/login.php?error=" . urlencode("Rol de usuario no reconocido."));
                                break;
                        }
                        exit;
                    } else {
                        header("Location: ../login/login.php?error=" . urlencode("Rol de usuario no reconocido."));
                        exit;
                    }
                } else {
                    header("Location: ../login/login.php?error=" . urlencode("Error en la preparación de la consulta de rol."));
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
    header("Location: ../login/login.php");
    exit;
}
?>
