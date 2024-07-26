<?php
// Incluir funciones desde el archivo en la misma carpeta
include 'functions.php';

// Cargar permisos desde el archivo en la misma carpeta
$permisos = include 'permisos.php';

// Verificar si $permisos es un array
if (!is_array($permisos)) {
    die('No se pudieron cargar los permisos.');
}

// Lista de roles y funcionalidades
$roles = array_keys($permisos);

// Extraer funcionalidades de cada rol en un array plano
$funcionalidades = [];
foreach ($permisos as $rol => $funciones) {
    $funcionalidades = array_merge($funcionalidades, array_keys($funciones));
}
$funcionalidades = array_unique($funcionalidades);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Permisos</title>
    <!-- Enlazar el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Puedes agregar aquí el contenido del encabezado si es necesario -->
    <!-- Puedes agregar aquí el contenido de navegación si es necesario -->

    <div class="container my-4">
        <h2 class="mb-4">Gestión de Permisos</h2>

        <!-- Formulario para gestionar permisos -->
        <form method="post" action="actualizar_permisos.php">
            <div class="row">
                <?php
                $roles_chunks = array_chunk($roles, ceil(count($roles) / 3)); // Divide roles en 3 columnas
                foreach ($roles_chunks as $roles_chunk): ?>
                    <div class="col-md-4">
                        <?php foreach ($roles_chunk as $rol): ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title"><?php echo htmlspecialchars($rol); ?></h5>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($funcionalidades as $funcionalidad): ?>
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="<?php echo htmlspecialchars($rol . '-' . $funcionalidad); ?>" 
                                                name="permisos[<?php echo htmlspecialchars($rol); ?>][<?php echo htmlspecialchars($funcionalidad); ?>]" 
                                                <?php echo isset($permisos[$rol][$funcionalidad]) && $permisos[$rol][$funcionalidad] ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="<?php echo htmlspecialchars($rol . '-' . $funcionalidad); ?>">
                                                <?php echo htmlspecialchars($funcionalidad); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Actualizar Permisos</button>
                <a href="../index.php" class="btn btn-secondary">Volver</a> <!-- Botón Volver -->
            </div>
        </form>
    </div>

    <!-- Enlazar los archivos JS de Bootstrap y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
