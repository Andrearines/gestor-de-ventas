<?php \components\ComponentManager::make('alert/alertas', ['alertas' => $alertas])->echo(); ?>

<div class="vendor-dashboard-container">
    <!-- Stats Row -->
    <div class="vendor-stats-grid">
        <!-- Entradas Asignadas -->
        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Entradas Asignadas</p>
                <h3 class="stat-value"><?php echo $vendor_stats['asignados'] ?? 100; ?></h3>
            </div>
        </div>

        <!-- Vendidas -->
        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Vendidas</p>
                <h3 class="stat-value"><?php echo $vendor_stats['vendidos'] ?? 45; ?></h3>
            </div>
        </div>

        <!-- Disponibles -->
        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Disponibles</p>
                <h3 class="stat-value"><?php echo $vendor_stats['disponibles'] ?? 55; ?></h3>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-section">
        <div class="section-header">
            <h2>Acciones Rápidas</h2>
            <p>Gestiona tus ventas y reservas</p>
        </div>

        <div class="actions-grid">
            <a href="/vendor/sales" class="action-card action-card-primary">
                <div class="action-icon">
                    <i class="fa-solid fa-plus-circle"></i>
                </div>
                <div class="action-content">
                    <h3>Registrar Venta</h3>
                    <p>Registra una nueva venta de boleto</p>
                </div>
                <div class="action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="/vendor/reservations" class="action-card">
                <div class="action-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="action-content">
                    <h3>Ver Reservas</h3>
                    <p>Gestiona tus reservas activas</p>
                </div>
                <div class="action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="/vendor/tickets" class="action-card">
                <div class="action-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="action-content">
                    <h3>Mis Boletos</h3>
                    <p>Ver todos tus boletos asignados</p>
                </div>
                <div class="action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="/vendor/stats" class="action-card">
                <div class="action-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="action-content">
                    <h3>Estadísticas</h3>
                    <p>Revisa tu rendimiento</p>
                </div>
                <div class="action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Sales -->
    <div class="recent-sales-section">
        <div class="section-header">
            <h2>Ventas Recientes</h2>
            <a href="/vendor/sales" class="view-all-link">Ver todas</a>
        </div>

        <div class="sales-list">
            <?php
            $recent_sales = $vendor_stats['recent_sales'] ?? [
                ['ticket' => '#045', 'customer' => 'Maria Gonzalez', 'event' => "Wendy's Fest", 'date' => '12 Oct, 14:30', 'amount' => '$350.00'],
                ['ticket' => '#044', 'customer' => 'Juan Perez', 'event' => "Wendy's Fest", 'date' => '12 Oct, 13:15', 'amount' => '$350.00'],
                ['ticket' => '#043', 'customer' => 'Ana Soto', 'event' => "Wendy's Fest", 'date' => '11 Oct, 18:45', 'amount' => '$350.00'],
            ];
            foreach ($recent_sales as $sale):
                ?>
                <div class="sale-item">
                    <div class="sale-ticket">
                        <div class="ticket-icon">
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <div class="ticket-info">
                            <p class="ticket-number"><?php echo $sale['ticket']; ?></p>
                            <p class="ticket-event"><?php echo $sale['event']; ?></p>
                        </div>
                    </div>
                    <div class="sale-customer">
                        <p><?php echo $sale['customer']; ?></p>
                    </div>
                    <div class="sale-date">
                        <p><?php echo $sale['date']; ?></p>
                    </div>
                    <div class="sale-amount">
                        <p><?php echo $sale['amount']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>