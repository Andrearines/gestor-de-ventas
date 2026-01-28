document.addEventListener('DOMContentLoaded', () => {
    const statsRaw = document.getElementById('php-vendor-stats').value;
    const stats = JSON.parse(statsRaw);
    console.log('Estadísticas del vendedor:', stats);
});
