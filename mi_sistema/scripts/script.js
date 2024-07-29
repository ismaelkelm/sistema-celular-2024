document.getElementById('status-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario

    const orderNumber = document.getElementById('order-number').value.trim();
    const statusResult = document.getElementById('status-result');

    // Realizar una solicitud AJAX al servidor
    fetch('../base_datos/check_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ 'order_number': orderNumber })
    })
    .then(response => response.json())
    .then(data => {
        // Mostrar el estado en el HTML
        statusResult.innerHTML = `<div class="status ${data.class}">${data.text}</div>`;
    })
    .catch(error => {
        console.error('Error:', error);
        statusResult.innerHTML = '<div class="alert alert-danger">Error al obtener el estado.</div>';
    });
});
