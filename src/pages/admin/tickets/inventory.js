document.addEventListener('DOMContentLoaded', () => {
    const ticketsRaw = document.getElementById('php-tickets').value;
    const tickets = JSON.parse(ticketsRaw);
    console.log('Inventario cargado:', tickets);
});
