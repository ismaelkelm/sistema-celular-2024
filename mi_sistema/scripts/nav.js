console.log("nav.js cargado");

$(document).ready(function() {
    console.log("Documento listo. Asignando manejadores de eventos...");

    // Manejar clic en los enlaces del nav
    $('.nav-link[data-url]').on('click', function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto

        var url = $(this).data('url'); // Obtener la URL del atributo data-url
        console.log("Cargando URL: " + url);

        // Cargar el contenido de la URL en el contenedor
        $('#content-container').load(url)
            .fail(function() {
                $('#content-container').html('<p>Hubo un error al cargar el contenido.</p>');
            });
    });

    // Cargar una página por defecto si es la primera carga
    if (window.location.pathname === '/' || window.location.pathname === '/mi_sistema/') {
        console.log("Cargando contenido por defecto...");
        $('#content-container').load('base_datos/gestionar_permisos.php')
            .fail(function() {
                $('#content-container').html('<p>Hubo un error al cargar el contenido por defecto.</p>');
            });
    }
});
