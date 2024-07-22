// scripts.js

/**
 * Muestra un mensaje de alerta.
 *
 * @param {string} message El mensaje a mostrar.
 */
function showAlert(message) {
    alert(message);
}

/**
 * Maneja el evento de envío del formulario.
 *
 * @param {Event} event El evento de envío del formulario.
 */
function handleFormSubmit(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto
    showAlert('Formulario enviado exitosamente.');
}

// Añadir evento de envío al formulario con id 'myForm'
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('myForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
});
