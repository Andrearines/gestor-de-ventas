<?php
// Vista de detalle del evento
?>

<div class="event-detail-container">
    <div class="detail-header">
        <div class="header-info">
            <a href="/admin/events" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                Volver a eventos
            </a>
            <h1>Detalle del Evento #
                <?php echo $id; ?>
            </h1>
            <p>Visualiza el rendimiento y los datos generales del evento.</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary" onclick="editEvent(<?php echo $id; ?>)">
                <i class="fa-solid fa-pen"></i>
                Editar
            </button>
            <button class="btn btn-danger" onclick="confirmDelete(<?php echo $id; ?>, 'Evento #<?php echo $id; ?>')">
                <i class="fa-solid fa-trash"></i>
                Eliminar
            </button>
        </div>
    </div>

    <div class="detail-grid">
        <!-- Información General -->
        <div class="detail-card info-card">
            <h3><i class="fa-solid fa-circle-info"></i> Información General</h3>
            <div class="info-content">
                <div class="info-item">
                    <span class="label">Nombre:</span>
                    <span class="value">Recaudación Escuela Norte</span>
                </div>
                <div class="info-item">
                    <span class="label">Fecha:</span>
                    <span class="value">25 Oct, 2023 - 18:00</span>
                </div>
                <div class="info-item">
                    <span class="label">Ubicación:</span>
                    <span class="value">Auditorio Municipal</span>
                </div>
                <div class="info-item">
                    <span class="label">Estado:</span>
                    <span class="status-badge status-activo">Activo</span>
                </div>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="detail-card stats-card">
            <h3><i class="fa-solid fa-chart-line"></i> Resumen de Ventas</h3>
            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-label">Vendidos</span>
                    <span class="stat-value">350</span>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Disponibles</span>
                    <span class="stat-value">150</span>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Ingresos</span>
                    <span class="stat-value">$17,500.00</span>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Asistencia</span>
                    <span class="stat-value">70%</span>
                </div>
            </div>
        </div>

        <!-- Tabla de Boletos Relacionados -->
        <div class="detail-card table-card full-width">
            <div class="card-header">
                <h3><i class="fa-solid fa-ticket"></i> Boletos Asignados</h3>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Vendedor</th>
                            <th>Estado</th>
                            <th>Última Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>Juan Pérez</td>
                            <td><span class="status-badge status-vendido">Vendido</span></td>
                            <td>Hace 10 min</td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>Juan Pérez</td>
                            <td><span class="status-badge status-asignado">Asignado</span></td>
                            <td>Hace 1 hora</td>
                        </tr>
                        <tr>
                            <td>#1003</td>
                            <td>Sin asignar</td>
                            <td><span class="status-badge status-disponible">Disponible</span></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .event-detail-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .detail-header h1 {
        font-size: 2rem;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .detail-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .detail-card.full-width {
        grid-column: span 2;
    }

    .detail-card h3 {
        font-size: 1.1rem;
        margin-bottom: 1.25rem;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 0.5rem;
    }

    .info-item .label {
        color: #6b7280;
    }

    .info-item .value {
        font-weight: 600;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .stat-box {
        background: #f8fafc;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
    }

    .stat-label {
        display: block;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary);
    }

    .full-width {
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-card.full-width {
            grid-column: span 1;
        }
    }
</style>