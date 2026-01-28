<div class="events-container">
    <!-- Breadcrumbs & Header -->
    <div class="events-header">
        <div class="header-left">
            <nav class="breadcrumbs">
                <a href="/admin/dashboard">Dashboard</a>
                <span class="separator">/</span>
                <span class="current">Eventos</span>
            </nav>
            <h1>Gestión de Eventos</h1>
        </div>
        <a href="/admin/events/create" class="btn-primary-action">
            <i class="fa-solid fa-plus"></i>
            Nuevo Evento
        </a>
    </div>

    <!-- Toolbar -->
    <div class="toolbar-section">
        <!-- Search -->
        <div class="search-wrapper">
            <div class="search-icon">
                <i class="fa-solid fa-search"></i>
            </div>
            <input type="text" id="eventSearch" class="search-input" placeholder="Buscar evento por nombre, lugar...">
        </div>

        <!-- Filters -->
        <div class="filters-wrapper">
            <button class="filter-btn active">Todos</button>
            <button class="filter-btn">Activos</button>
            <button class="filter-btn">Borradores</button>
            <button class="filter-btn">Finalizados</button>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="events-table">
                <thead>
                    <tr>
                        <th class="col-event">Evento</th>
                        <th class="col-date">Fecha & Lugar</th>
                        <th class="col-tickets text-center">Boletos</th>
                        <th class="col-status text-center">Status</th>
                        <th class="col-actions text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($eventos)): ?>
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="empty-content">
                                    <div class="empty-icon">
                                        <i class="fa-regular fa-calendar-xmark"></i>
                                    </div>
                                    <p>No hay eventos registrados aún.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($eventos as $evento): ?>
                            <tr class="event-row">
                                <td class="col-event">
                                    <div class="event-info">
                                        <span class="event-name"><?php echo $evento->nombre; ?></span>
                                        <span class="event-id">ID:
                                            #<?php echo str_pad($evento->id, 4, '0', STR_PAD_LEFT); ?></span>
                                    </div>
                                </td>
                                <td class="col-date">
                                    <div class="date-info">
                                        <div class="date-item">
                                            <i class="fa-regular fa-calendar"></i>
                                            <?php echo $evento->fecha; ?>
                                        </div>
                                        <div class="location-item">
                                            <i class="fa-solid fa-location-dot"></i>
                                            Hotel Chulavista
                                        </div>
                                    </div>
                                </td>
                                <td class="col-tickets">
                                    <div class="ticket-stats">
                                        <span class="ticket-count">120</span>
                                        <span class="ticket-label">Vendidos</span>
                                    </div>
                                </td>
                                <td class="col-status text-center">
                                    <span class="status-badge active">
                                        <span class="dot"></span>
                                        Activo
                                    </span>
                                </td>
                                <td class="col-actions text-center">
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Ver Detalles">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button class="btn-icon edit" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn-icon delete" title="Eliminar">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="pagination-section">
            <span class="pagination-info">Mostrando 1-10 de 12 eventos</span>
            <div class="pagination-controls">
                <button class="btn-page" disabled>Anterior</button>
                <button class="btn-page hoverable">Siguiente</button>
            </div>
        </div>
    </div>
</div>

<script src="/build/js/events/index.js"></script>