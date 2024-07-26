// script.js
document.getElementById('status-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario

    const orderNumber = document.getElementById('order-number').value.trim();
    const statusResult = document.getElementById('status-result');

    // Simular la obtención del estado desde un servidor
    // Aquí puedes reemplazar esto con una llamada a tu servidor real
    const status = getOrderStatus(orderNumber); 

    // Mostrar el estado en el HTML
    statusResult.innerHTML = `<div class="status ${status.class}">${status.text}</div>`;
});

// Función de simulación de estado de la orden
function getOrderStatus(orderNumber) {
    // Aquí puedes agregar lógica para consultar el estado real
    // De momento, devolvemos un estado simulado
    const statuses = [
        { class: 'in-progress', text: 'En Progreso' },
        { class: 'completed', text: 'Completado' },
        { class: 'pending', text: 'Pendiente' }
    ];

    // Simulamos un estado basado en el número de orden
    // Esto debería ser reemplazado por lógica real de consulta
    const index = orderNumber % statuses.length;
    return statuses[index];
}
