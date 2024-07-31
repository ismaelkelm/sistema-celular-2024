<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Mi Empresa'; ?></title>
    <!-- Enlazar el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlazar Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Enlazar CSS personalizado -->
    <link rel="stylesheet" href="../../mi_sistema/estilos/estilo.css">
    <style>
        /* Estilo para el contenedor del título */
        #title-container {
            text-align: center;
            margin-top: 1rem; /* Ajusta según sea necesario */
            margin-bottom: 1rem; /* Ajusta según sea necesario */
        }

        /* Estilo para el botón del título */
        #title-button {
            font-size: 1rem; /* Tamaño grande del texto del botón */
            color: #ffffff; /* Color del texto del botón */
            background-color: #007bff; /* Fondo del botón */
            border: none; /* Sin borde */
            cursor: pointer; /* Cursor de puntero para el botón */
            text-decoration: none; /* Sin subrayado */
            padding: 1rem 1rem; /* Espaciado interno */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: background-color 0.3s, color 0.3s; /* Transición de colores */
        }

        /* Cambios de estilo al pasar el cursor por encima */
        #title-button:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el cursor */
            color: #ffffff; /* Color del texto al pasar el cursor */
        }
    </style>
</head>
<body>
    <!-- Contenedor del Título -->
    <div id="title-container" class="container">
        <button id="title-button" onclick="window.location.reload(); return false;">
            EMPRESARIO 
        </button>
    </div>

    <!-- Agregar la barra de navegación -->
    <?php include('nav.php'); ?>
</body>
</html>