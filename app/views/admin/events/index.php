<?php
use components\ComponentManager;
$alertasComponent = new ComponentManager("alert/alertas", ['alertas' => $alert]);
$alertasComponent->echo();

?>
<div class="events-container">
    <!-- Header con alertas -->
    <div class="events-header">
        <div class="header-title">
            <h1>Gestión de Eventos</h1>
            <p>Administra todos los eventos benéficos</p>
        </div>
        <div class="header-actions">
            <button class="btn-filter" onclick="toggleFilters()">
                <i class="fa-solid fa-filter"></i>
                Filtros
            </button>
            <a href="/admin/events/create" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Nuevo Evento
            </a>
        </div>
    </div>
    <!-- Filtros (ocultos por defecto) -->
    <div class="filters-panel" id="filtersPanel" style="display: none;">
        <div class="filters-grid">
            <div class="filter-group">
                <label>Estado</label>
                <select id="filterStatus" onchange="applyFilters()">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Fecha</label>
                <input type="date" id="filterDate" onchange="applyFilters()">
            </div>
            <div class="filter-group">
                <label>Búsqueda</label>
                <input type="text" id="filterSearch" placeholder="Buscar evento..." oninput="applyFilters()">
            </div>
        </div>
    </div>

    <!-- Stats rápidos -->
    <div class="events-stats">
        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Eventos Activos</p>
                <h3 class="stat-value"><?php echo $stats['activos'] ?? 0; ?></h3>
            </div>
        </div>
        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Boletos Vendidos</p>
                <h3 class="stat-value"><?php echo number_format($stats['boletos_vendidos'] ?? 0); ?></h3>
            </div>
        </div>
        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Ingresos Totales</p>
                <h3 class="stat-value">$<?php echo number_format($stats['ingresos'] ?? 0, 2); ?></h3>
            </div>
        </div>
    </div>

    <!-- Tabla de eventos -->
    <div class="events-table-container">
        <table class="events-table" id="eventsTable">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Fecha</th>
                    <th>Ubicación</th>
                    <th>Boletos</th>
                    <th>Vendidos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $events = $events ?? [];
                foreach ($events as $event):
                    ?>
                    <tr data-status="<?php echo $event['status']; ?>" data-date="<?php echo $event['fecha']; ?>">
                        <td>
                            <div class="event-info">
                                <div class="event-icon">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <div>
                                    <p class="event-name">
                                        <?php echo $event['nombre']; ?>
                                    </p>
                                    <p class="event-category">
                                        <?php echo $event['categoria'] ?? 'General'; ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="event-date">
                                <?php echo date('d M, Y', strtotime($event['fecha'])); ?>
                            </p>
                            <p class="event-time">
                                <?php echo $event['hora'] ?? '00:00'; ?>
                            </p>
                        </td>
                        <td>
                            <?php echo $event['ubicacion']; ?>
                        </td>
                        <td>
                            <?php echo number_format($event['total_boletos']); ?>
                        </td>
                        <td>
                            <div class="progress-info">
                                <span>
                                    <?php echo number_format($event['boletos_vendidos']); ?>
                                </span>
                                <div class="progress-bar">
                                    <div class="progress-fill"
                                        style="width: <?php echo ($event['boletos_vendidos'] / $event['total_boletos'] * 100); ?>%">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-<?php echo $event['status']; ?>">
                                <?php
                                $statusLabels = [
                                    'activo' => 'Activo',
                                    'finalizado' => 'Finalizado',
                                    'cancelado' => 'Cancelado'
                                ];
                                echo $statusLabels[$event['status']] ?? $event['status'];
                                ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">

                                <button class="btn-icon" onclick="editEvent(<?php echo $event['id']; ?>)" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn-icon btn-danger"
                                    onclick="confirmDelete(<?php echo $event['id']; ?>, '<?php echo $event['nombre']; ?>')"
                                    title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div class="modal" id="deleteModal" style="display: none;">
    <div class="modal-overlay" onclick="closeDeleteModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Confirmar Eliminación</h3>
            <button class="modal-close" onclick="closeDeleteModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>¿Estás seguro de que deseas eliminar el evento <strong id="eventNameToDelete"></strong>?</p>
            <p class="text-warning">Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
            <button class="btn btn-danger" onclick="deleteEvent()">Eliminar</button>
        </div>
    </div>
</div>



<style>
    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
</style>