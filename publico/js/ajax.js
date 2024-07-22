// ajax.js

/**
 * Realiza una petición AJAX a la URL proporcionada.
 *
 * @param {string} url La URL a la que se realiza la petición.
 * @param {string} method El método HTTP a utilizar (por defecto 'GET').
 * @param {Object} data Los datos a enviar con la petición (solo para métodos POST y PUT).
 * @param {function} onSuccess Función a ejecutar si la petición es exitosa.
 * @param {function} onError Función a ejecutar si ocurre un error.
 */
function ajaxRequest(url, method = 'GET', data = null, onSuccess, onError) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                var response = JSON.parse(xhr.responseText);
                onSuccess(response);
            } catch (e) {
                onError('Error al analizar la respuesta JSON.');
            }
        } else {
            onError('Error en la petición: ' + xhr.status);
        }
    };

    xhr.onerror = function() {
        onError('Error de red.');
    };

    if (data) {
        xhr.send(JSON.stringify(data));
    } else {
        xhr.send();
    }
}

// Ejemplo de uso de ajaxRequest
document.addEventListener('DOMContentLoaded', function() {
    var fetchDataButton = document.getElementById('fetchDataButton');
    if (fetchDataButton) {
        fetchDataButton.addEventListener('click', function() {
            ajaxRequest(
                'https://api.example.com/data',
                'GET',
                null,
                function(response) {
                    console.log('Datos recibidos:', response);
                },
                function(error) {
                    console.error('Error:', error);
                }
            );
        });
    }
});
