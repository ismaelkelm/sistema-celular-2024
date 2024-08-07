<?php
echo "Tecnicoooo";
session_start();

// Incluir el archivo de conexión
require '../base_datos/db.php'; // Usar require_once para evitar inclusiones múltiples
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
                <li class="nav-item">
                    <a href="../login/logout.php" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
</body>
</html>