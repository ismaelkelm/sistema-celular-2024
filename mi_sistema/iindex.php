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
        nav {
            position: relative;
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Justifica el contenido del nav a los extremos */
        }
        .nav-header {
            color: white;
            font-size: 49px;
            text-align: center;
            flex: 1;
            animation: colorChange 3s infinite; /* Animación de colores */
        }
        @keyframes colorChange {
            0% { color: blue; }
            50% { color: white; }
            100% { color: green; }
        }
        .menu-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            margin: 0; /* Elimina el margen superior */
            display: flex; /* Asegúrate de que esté visible */
            align-items: center;
            justify-content: center;
        }
        .menu-btn:hover {
            background-color: red;
        }
        .nav-menu {
            display: none;
            list-style-type: none;
            padding: 0;
            margin: 0;
            position: absolute; /* Posición absoluta para que aparezca debajo del botón */
            top: 60px; /* Ajusta según la altura del botón y del texto */
            right: 0;
            background-color: transparent; /* Fondo transparente */
            z-index: 1; /* Asegura que el menú esté por encima de otros elementos */
        }
        .nav-menu li {
            margin: 0;
        }
        .nav-menu li a {
            color: white; /* Color blanco para el texto */
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .nav-menu li a:hover {
            background-color: transparent; /* Fondo transparente al pasar el ratón */
            color: yellow; /* Cambia el color del texto al pasar el ratón */
        }
        .carousel {
            position: relative;
            width: 100%; /* Asegura que el carrusel ocupe todo el ancho de la pantalla */
            margin: auto;
            overflow: hidden;
            /* border-radius: 8px; */
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .carousel img {
            width: 100%; /* Asegura que las imágenes ocupen todo el ancho del carrusel */
            height: 250px; /* Mantiene la altura del carrusel fija */
            object-fit: cover; /* Ajusta la imagen para cubrir el área sin recortes */
            display: block; /* Evita que haya espacios en blanco alrededor de la imagen */
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
            /* font-size: 18px; */
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
            padding: 0; /* Elimina el padding para el contenedor */
            margin: 0; /* Elimina el margen para que el contenedor se ajuste al contenido */
        }
        .services {
            position: relative;
            text-align: center;
            background: url('media/reparacion_electronica.jpg') no-repeat center center;
            background-size: cover;
            padding: 80px 0; /* Añade espacio arriba y abajo */
            color: black;
        }
        .services h2 {
            margin-bottom: 10px;
            color: black;
        }
        .services .service {
            background-color: orange; /* Fondo blanco semitransparente para los recuadros */
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 0 1px rgba(0,0,0,0.1);
            margin: 15px auto; /* Añadido margen para centrar los recuadros */
            width: 80%; /* Ajusta el ancho para centrado en pantalla */
            max-width: 260px; /* Limita el ancho máximo de los recuadros */
            text-align: center; /* Alinea el texto a la izquierda */
            transition: background-color 0.3s, color 0.3s; /* Transición para el cambio de color */
        }
        .services .service:hover {
            background-color: blue; /* Cambia el color de fondo al pasar el mouse */
            color: blueviolet; /* Cambia el color del texto al pasar el mouse */
        }
        .services .service h3 {
            margin: 0;
            color: inherit; /* Usa el color heredado del contenedor */
            font-size: 20px;
        }
        .upload-section {
            text-align: center;
            margin-top: 40px;
        }
        .upload-section input[type="file"] {
            margin: 20px 0;
        }
        footer {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: underline;
            width: 100%;
            margin-top: 0; /* Elimina el margen para que el pie de página toque el contenedor de servicios */
        }
        footer .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            align-items: center;
            gap: 10px;
        }
        footer .container p, footer .container a {
            margin: 0;
        }
        footer .qr-code {
            width: 50px; /* Ajusta el tamaño del código QR */
            height: auto;
            transition: transform 0.1s; /* Añade una transición para el escalado */
        }
        footer .qr-code:hover {
            transform: scale(1.8); /* Escala la imagen al pasar el mouse */
        }

        /* Botón de WhatsApp flotante */
        .whatsapp-bubble {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 50px; /* Tamaño del botón */
            height: 50px; /* Tamaño del botón */
            z-index: 1000; /* Asegura que esté por encima de otros elementos */
            cursor: pointer;
            transition: transform 0.3s; /* Añade una transición para el escalado */
        }
        .whatsapp-bubble img {
            width: 100%;
            height: 100%;
            border-radius: 50%; /* Hace que el botón sea redondo */
        }
        .whatsapp-bubble:hover {
            transform: scale(1.1); /* Agranda el botón cuando se pasa el mouse por encima */
        }

        /* Media queries para dispositivos móviles */
        @media (max-width: 768px) {
            .nav-menu {
                position: static; /* Cambia la posición para que no se superponga */
                width: 100%; /* Ocupa todo el ancho disponible */
            }
            .nav-menu li {
                border-top: 1px solid #fff; /* Separadores entre los elementos del menú */
            }
            .nav-menu li a {
                padding: 15px 10px; /* Ajusta el padding en dispositivos móviles */
                font-size: 16px; /* Ajusta el tamaño de la fuente en dispositivos móviles */
            }
            .menu-btn {
                display: block; /* Muestra el botón en dispositivos móviles */
            }
            .services {
                display: flex;
                flex-direction: column; /* Alinea los servicios en columna en dispositivos móviles */
                align-items: center; /* Centra los elementos */
            }
            .services .service {
                width: 100%; /* Ajusta el ancho de los recuadros en dispositivos móviles */
                max-width: 300px; /* Limita el ancho máximo de los recuadros */
                margin: 10px 0; /* Añadido margen para dispositivos móviles */
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-header">
            Marquez Comunicaciones
        </div>
        <button class="menu-btn" onclick="toggleMenu()">Menú</button>
        <ul class="nav-menu">
            <li><a href="../mi_sistema/login/login.php">Login</a></li>
            <li><a href="../mi_sistema/base_datos/check_status.php">Estado de reparacion</a></li>
        </ul>
    </nav>
    <div class="carousel">
        <img class="mySlides" src="../mi_sistema/presentacion/reparacion-computadoras.jpg" alt="Imagen 1">
        <img class="mySlides" src="../mi_sistema/presentacion/reparacion_de_celulares.jpg" alt="Imagen 2">
        <img class="mySlides" src="../mi_sistema/presentacion/reparacion_electronica.jpg" alt="Imagen 3">
        <a class="nav-button prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="nav-button next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <div class="container">
        <div class="services">
            <h2>Nuestros Servicios</h2>
            <div class="service">
                <h3>Pcs</h3>
            </div>
            <div class="service">
                <h3>Celulares</h3>
            </div>
            <div class="service">
                <h3>Instalación de Redes</h3>
            </div>
            <div class="service">
                <h3>Desarrollo de Software</h3>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Servicio Técnico. Todos los derechos reservados.</p>
            <p>Síguenos en <a href="https://www.instagram.com/tu_cuenta_de_instagram" target="_blank" class="text-white">Instagram</a></p>
            <img src="../mi_sistema/presentacion/insta.png" alt="Código QR" class="qr-code">
            <a href="mailto:emailDeltecnico@gmail.com" class="text-white">emailDeltecnico@gmail.com</a>
            <img src="../mi_sistema/presentacion/QR.png" alt="Código QR" class="qr-code">
        </div>
    </footer>
    <a href="https://wa.me/15551234567" target="_blank" class="whatsapp-bubble" id="draggable">
    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp">
    </a>
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

        function toggleMenu() {
            const menu = document.querySelector('.nav-menu');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
</body>
</html>
