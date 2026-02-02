<?php \components\ComponentManager::make('alert/alertas', ['alertas' => $alertas])->echo(); ?>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-title">
            <h1>Bienvenido, Administrador</h1>
            <p>Aquí tienes un resumen de la actividad reciente y métricas clave.</p>
        </div>
        <div class="header-actions">
            <a href="/admin/events/create" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Nuevo Evento
            </a>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="kpi-grid">
        <!-- Ventas Totales -->
        <div class="kpi-card">
            <div class="card-icon-bg">
                <i class="fa-solid fa-dollar-sign text-success"></i>
            </div>
            <div class="card-content">
                <p class="kpi-label">Ventas Totales</p>
                <h3 class="kpi-value">$<?php echo number_format($stats['ventas_totales'] ?? 124500, 2); ?></h3>
                <span class="kpi-trend positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    +12.5%
                </span>
            </div>
        </div>

        <!-- Boletos Activos -->
        <div class="kpi-card">
            <div class="card-icon-bg">
                <i class="fa-solid fa-ticket text-primary"></i>
            </div>
            <div class="card-content">
                <p class="kpi-label">Boletos Activos</p>
                <h3 class="kpi-value"><?php echo number_format($stats['boletos_activos'] ?? 3420); ?></h3>
                <span class="kpi-trend positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    +5.2%
                </span>
            </div>
        </div>

        <!-- Combos Vendidos -->
        <div class="kpi-card">
            <div class="card-icon-bg">
                <i class="fa-solid fa-burger text-warning"></i>
            </div>
            <div class="card-content">
                <p class="kpi-label">Combos Vendidos</p>
                <h3 class="kpi-value"><?php echo number_format($stats['combos_vendidos'] ?? 850); ?></h3>
                <span class="kpi-trend">
                    <i class="fa-solid fa-minus"></i>
                    +0.0%
                </span>
            </div>
        </div>

        <!-- Eventos Activos -->
        <div class="kpi-card">
            <div class="card-icon-bg">
                <i class="fa-solid fa-calendar-days text-info"></i>
            </div>
            <div class="card-content">
                <p class="kpi-label">Eventos Activos</p>
                <h3 class="kpi-value"><?php echo number_format($stats['eventos_activos'] ?? 12); ?></h3>
                <p class="kpi-subtitle">De <?php echo $stats['total_eventos'] ?? 24; ?> totales</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <!-- Ventas por Vendedor -->
        <div class="chart-card">
            <div class="card-header">
                <div>
                    <h3>Ventas por Proveedor</h3>
                    <p>Top vendedores del mes</p>
                </div>
                <button class="chart-filter">
                    <i class="fa-solid fa-filter"></i>
                    Este mes
                </button>
            </div>
            <div class="chart-container">
                <?php
                $top_sellers = $stats['top_sellers'] ?? [
                    ['name' => 'Ricardo Luna', 'initials' => 'RL', 'total' => '$12,450'],
                    ['name' => 'Marta Martínez', 'initials' => 'MM', 'total' => '$8,960'],
                    ['name' => 'Andrés Sosa', 'initials' => 'AS', 'total' => '$7,410'],
                    ['name' => 'Carlos Pérez', 'initials' => 'CP', 'total' => '$5,230'],
                ];

                $chartId = 'salesChart';
                $labels = array_map(function ($seller) {
                    return $seller['name'];
                }, $top_sellers);
                $data = array_map(function ($seller) {
                    return (float) str_replace(['$', ','], '', $seller['total']);
                }, $top_sellers);
                $label = 'Ventas ($)';
                ?>
                <div class="chart-wrapper" style="height: 300px;">
                    <?php include __DIR__ . '/components/bar_chart.php'; ?>
                </div>
            </div>
        </div>

        <!-- Top Vendedores -->
        <div class="chart-card">
            <div class="card-header">
                <h3>Top Vendedores</h3>
            </div>
            <div class="sellers-list custom-scrollbar">
                <?php
                foreach ($top_sellers as $index => $seller):
                    ?>
                    <div class="seller-item">
                        <div class="seller-avatar <?php echo $index > 0 ? 'secondary' : ''; ?>">
                            <?php echo $seller['initials']; ?>
                        </div>
                        <div class="seller-info">
                            <h4><?php echo $seller['name']; ?></h4>
                            <p>Vendedor</p>
                        </div>
                        <div class="seller-total"><?php echo $seller['total']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


</div>
</div>