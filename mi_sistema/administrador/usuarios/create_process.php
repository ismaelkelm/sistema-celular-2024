<?php
// Incluir el archivo de conexión a la base de datos
include '../../base_datos/db.php'; // Ajusta la ruta según la ubicación del archivo

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $DNI = $_POST['DNI'];
    $contraseña = $_POST['contraseña'];
    $email = $_POST['email'];
    $id_roles = intval($_POST['id_roles']); // Asegurarse de que id_roles es un entero

    // Encriptar la contraseña
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta de inserción
    $sql_insert = "INSERT INTO usuarios (nombre, DNI, contraseña, email, id_roles) VALUES (?, ?, ?, ?, ?)";

    if ($stmt_insert = $conn->prepare($sql_insert)) {
        $stmt_insert->bind_param("ssssi", $nombre, $DNI, $hashed_password, $email, $id_roles);
        if ($stmt_insert->execute()) {
            echo "Usuario insertado correctamente: " . htmlspecialchars($nombre) . "<br>";
        } else {
            echo "Error al insertar usuario " . htmlspecialchars($nombre) . ": " . $stmt_insert->error . "<br>";
        }
        $stmt_insert->close();
    } else {
        echo "Error al preparar la consulta de inserción: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
