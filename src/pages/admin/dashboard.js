document.addEventListener('DOMContentLoaded', () => {
    // Cargar datos de PHP
    const statsRaw = document.getElementById('php-stats').value;
    const stats = JSON.parse(statsRaw);

    console.log('Estadísticas cargadas:', stats);

    // Aquí se inicializarían los gráficos con Chart.js u otras librerías
});
