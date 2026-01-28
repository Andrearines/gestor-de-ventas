document.addEventListener('DOMContentLoaded', () => {
    const eventosRaw = document.getElementById('php-eventos').value;
    const eventos = JSON.parse(eventosRaw);
    console.log('Eventos cargados en el listado:', eventos);

    // Lógica para filtrar tabla, etc.
});
