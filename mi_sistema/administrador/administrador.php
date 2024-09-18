
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome para iconos -->
    <style>
        .card-icon {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            background-color: #f9f9f9;
        }
        .card-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-icon i {
            color: #007bff;
            font-size: 2rem; /* Ajusta el tamaño del icono aquí */
            transition: color 0.3s ease;
        }
        .card-icon:hover i {
            color: #dc3545; /* Cambia el color al pasar el ratón */
        }
        .card-icon .card-body {
            padding: 1.5rem;
        }
        .card-title {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<?php include('../includes/nav.php'); ?>
    <p>Panel de Control - Administrador</p>
    
</html>

