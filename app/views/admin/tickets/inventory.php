<div class="inventory-container">
    <!-- Header -->
    <div class="inventory-header">
        <div class="header-title">
            <h1>Inventario de Boletos</h1>
            <p>Control individual y auditoría de boletos físicos por evento.</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary" onclick="exportInventory()">
                <i class="fa-solid fa-file-export"></i>
                Exportar
            </button>
            <button class="btn btn-primary" onclick="openGenerateModal()">
                <i class="fa-solid fa-plus"></i>
                Generar Rango
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="inventory-stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon"><i class="fa-solid fa-ticket"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Boletos</p>
                <h3 class="stat-value"><?php echo number_format($stats['total'] ?? 0); ?></h3>
            </div>
        </div>
        <div class="stat-card stat-sold">
            <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-info">
                <p class="stat-label">Vendidos</p>
                <h3 class="stat-value"><?php echo number_format($stats['vendidos'] ?? 0); ?></h3>
            </div>
        </div>
        <div class="stat-card stat-available">
            <div class="stat-icon"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-info">
                <p class="stat-label">Disponibles</p>
                <h3 class="stat-value"><?php echo number_format($stats['disponibles'] ?? 0); ?></h3>
            </div>
        </div>
        <div class="stat-card stat-lost">
            <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="stat-info">
                <p class="stat-label">Perdidos</p>
                <h3 class="stat-value"><?php echo number_format($stats['perdidos'] ?? 0); ?></h3>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-card">
        <div class="card-header">
            <h3 class="card-title">Listado de Boletos</h3>
            <div class="card-tools">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="inventorySearch" placeholder="Buscar boleto # o evento..."
                        oninput="filterInventory()">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="inventory-table" id="inventoryTable">
                <thead>
                    <tr>
                        <th># Boleto</th>
                        <th>Evento</th>
                        <th>Vendedor Asignado</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td>
                                <span class="ticket-number">#<?php echo $ticket['numero']; ?></span>
                            </td>
                            <td><?php echo $ticket['evento']; ?></td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-sm"><?php echo substr($ticket['vendedor'], 0, 1); ?></div>
                                    <span><?php echo $ticket['vendedor']; ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo strtolower($ticket['status']); ?>">
                                    <?php echo $ticket['status']; ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <button class="action-btn" title="Más opciones">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Generar Rango -->
<div class="modal" id="generateModal" style="display: none;">
    <div class="modal-overlay" onclick="closeGenerateModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Generar Rango de Boletos</h3>
            <button class="modal-close" onclick="closeGenerateModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <form onsubmit="handleGenerate(event)">
            <div class="modal-body">
                <div class="form-group">
                    <label>Evento *</label>
                    <select required>
                        <option value="">Seleccionar evento...</option>
                        <option value="1">Escuela Norte</option>
                        <option value="2">Festival Jazz</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Desde Numero *</label>
                        <input type="number" required placeholder="1001">
                    </div>
                    <div class="form-group">
                        <label>Hasta Numero *</label>
                        <input type="number" required placeholder="2000">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeGenerateModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Generar Boletos</button>
            </div>
        </form>
    </div>
</div>