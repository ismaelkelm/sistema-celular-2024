<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOLAAAA</h1>
</body>
</html>


<?php
// Incluir funciones desde el archivo en la misma carpeta
include 'functions.php';

// Cargar permisos desde el archivo en la misma carpeta
$permisos = include 'permisos.php';

// Verificar si $permisos es un array
if (!is_array($permisos)) {
    die('No se pudieron cargar los permisos.');
}

// Obtener el rol del usuario
// $user_id = $_SESSION['user_id'];
$query = "SELECT id_roles FROM usuarios WHERE id_usuarios = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id_roles = $row['id_roles'];
$roles = array_keys($permisos);
$role_name = $roles[$id_roles] ?? null;

// Comprobar permisos del rol
$funcionalidades = $permisos[$role_name] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../estilos/styles.css">
</head>
<body>
    <!-- Contenido Principal -->
    <div class="container my-4">
        <h2 class="text-center">Panel de Control</h2>
        <div class="row">
            <?php if (isset($funcionalidades['Accesorios'])): ?>
                <div class="col-md-2 mb-4">
                    <a href="accesorios/index.php" class="btn btn-light p-3 d-block text-center">
                        <i class="fas fa-box fa-3x"></i>
                        <p class="mt-2">Accesorios</p>
                    </a>
                </div>
            <?php endif; ?>
            <!-- Añade aquí más funcionalidades según los permisos -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
