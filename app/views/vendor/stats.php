<div class="vendor-stats-container">
    <div class="header">
        <h1>Mis Estadísticas de Venta</h1>
        <p>Análisis detallado de tu desempeño.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Ventas</h3>
            <p class="value">$1,245.00</p>
            <span class="stat-trend positive">
                <i class="fa-solid fa-arrow-up"></i> +12% vs mes pasado
            </span>
        </div>
        <div class="stat-card">
            <h3>Boletos Vendidos</h3>
            <p class="value">45</p>
            <span class="stat-trend positive">
                <i class="fa-solid fa-arrow-up"></i> +5% vs mes pasado
            </span>
        </div>
        <div class="stat-card">
            <h3>Comisión Estimada</h3>
            <p class="value">$124.50</p>
            <span class="stat-trend">
                <i class="fa-solid fa-minus"></i> Estable
            </span>
        </div>
    </div>

    <div class="performance-graph">
        <h2>Desempeño Semanal</h2>
        <div class="chart-placeholder">
            <i class="fa-solid fa-chart-line"></i> Gráfico de rendimiento (Chart.js)
        </div>
    </div>
</div>

<style>
    .vendor-stats-container {
        padding: 2rem;
    }

    .header {
        margin-bottom: 2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    .stat-card h3 {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .stat-card .value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
    }
</style>