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
<<<<<<< HEAD
    <!-- <link rel="stylesheet" href="../../mi_sistema/estilos/estilo.css"> -->
=======
    <link rel="stylesheet" href="../estilos/estilo.css">
>>>>>>> d4b91334cfa2e337251e38335fa3420cf97863fc
    <style>
        /* Estilo para el contenedor del título */
        #title-container {
            text-align: center;
            margin: 1rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px; /* Puedes ajustar esta altura según tus necesidades */
        }

        /* Estilo para el botón del título */
        #title-button {
            font-size: 1.5rem; /* Tamaño grande del texto del botón */
            color: #fff; /* Color del texto del botón */
            background-color: green; /* Fondo del botón */
            border: none; /* Sin borde */
            cursor: pointer; /* Cursor de puntero para el botón */
            text-decoration: none; /* Sin subrayado */
            padding: 0.75rem 1.5rem; /* Espaciado interno */
            border-radius: 0.25rem; /* Bordes redondeados */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Transición de colores */
        }

        /* Cambios de estilo al pasar el cursor por encima */
        #title-button:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el cursor */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Sombra más intensa */
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            #title-container {
                height: auto;
                margin: 0.5rem 0;
            }
            #title-button {
                font-size: 1.2rem;
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor del Título -->
    <div id="title-container" class="container-fluid">
        <button id="title-button" onclick="window.location.reload(); return false;">
            Marquez Comunicación
        </button>
    </div>

    <!-- Agregar la barra de navegación -->
    <?php include('nav.php'); ?>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
