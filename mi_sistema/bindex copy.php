<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marquez Comunicaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
            font-size: 24px;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a, nav ul li .btn-login-nav {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
            padding: 12px 25px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        nav ul li a:hover, nav ul li .btn-login-nav:hover {
            text-decoration: underline;
        }
        nav ul li .btn-login-nav {
            background-color: #007bff;
            border: none;
        }
        nav ul li .btn-login-nav:hover {
            background-color: #0056b3;
        }
        .carousel {
            position: relative;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .carousel img {
            width: 100%;
            height: 350px; /* Ajusta la altura según lo necesites */
            object-fit: cover; /* Mantiene la proporción de la imagen y recorta el exceso si es necesario */
            display: block;
        }

        .carousel .nav-button {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0,0,0,0.5);
        }

        .carousel .prev {
            left: 0;
            border-radius: 3px 0 0 3px;
        }

        .carousel .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .container {
            flex: 1;
            padding: 20px;
        }
        .services {
            text-align: center;
        }
        .services h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .services .service {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .services .service h3 {
            margin: 0 0 10px 0;
            color: #007bff;
        }
        .upload-section {
            text-align: center;
            margin-top: 40px;
        }
        .upload-section input[type="file"] {
            margin: 20px 0;
        }
        footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        Marquez Comunicaciones
    </header>
    <nav>
        <ul>
            <li><button class="btn-login-nav" onclick="window.location.href='../mi_sistema/presentacion/aindex.html';">Reparacion</button></li>
            <li><button class="btn-login-nav" onclick="window.location.href='../mi_sistema/presentacion/presentacion.html';">presentacion</button></li>
            <li><button class="btn-login-nav" onclick="window.location.href='../mi_sistema/presentacion/presentacion2.html';">Iniciar Sesión</button></li>
            <li><button class="btn-login-nav" onclick="window.location.href='../mi_sistema/presentacion/pruebas.html';">Iniciar Sesión</button></li>
            <li><button class="btn-login-nav" onclick="window.location.href='../mi_sistema/login/login.php';">Iniciar Sesión</button></li>
        </ul>
    </nav>
    <div class="carousel">
        <img class="mySlides" src="media/reparacion-computadoras.jpg" alt="Imagen 1">
        <img class="mySlides" src="media/reparacion_de_celulares.jpg" alt="Imagen 2">
        <img class="mySlides" src="media/reparacion_electronica.jpg" alt="Imagen 3">
        <a class="nav-button prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="nav-button next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <div class="container">
        <div class="services">
            <h2>Nuestros Servicios</h2>
            <div class="service">
                <h3>Consultoría en Comunicaciones</h3>
                <p>Asesoramos a empresas en la optimización de sus estrategias de comunicación interna y externa.</p>
            </div>
            <div class="service">
                <h3>Instalación de Redes</h3>
                <p>Ofrecemos servicios de instalación y mantenimiento de redes de datos para garantizar una conexión eficiente.</p>
            </div>
            <div class="service">
                <h3>Desarrollo de Software</h3>
                <p>Desarrollamos soluciones de software personalizadas para satisfacer las necesidades específicas de nuestros clientes.</p>
            </div>
        </div>
  
    </div>
    <footer>
        © 2024 Marquez Comunicaciones. Todos los derechos reservados.
    </footer>
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            const slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Cambia la imagen cada 3 segundos
        }

        function plusSlides(n) {
            slideIndex += n;
            showSlides();
        }
    </script>
</body>
</html>
