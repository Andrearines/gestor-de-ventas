<div class="combos-container">
    <!-- Header -->
    <div class="combos-header">
        <div class="header-title">
            <h1>Gestión de Combos</h1>
            <p>Administra los paquetes de productos y promociones del sistema.</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openComboModal()">
                <i class="fa-solid fa-plus"></i>
                Nuevo Combo
            </button>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="combos-stats">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="fa-solid fa-burger"></i></div>
            <div class="stat-content">
                <span class="label">Combos vendidos</span>
                <h3 class="value">12</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success"><i class="fa-solid fa-chart-line"></i></div>
            <div class="stat-content">
                <span class="label">Total Vendidos</span>
                <h3 class="value">1,450</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning"><i class="fa-solid fa-tags"></i></div>
            <div class="stat-content">
                <span class="label">Promedio Precio</span>
                <h3 class="value">$18.50</h3>
            </div>
        </div>
    </div>

    <!-- Combos Grid -->
    <div class="combos-grid">
        <?php foreach ($combos as $combo): ?>
            <div class="combo-card <?php echo $combo['status'] === 'inactivo' ? 'inactive' : ''; ?>">
                <div class="card-options">
                    <button class="btn-icon" onclick="editCombo(<?php echo $combo['id']; ?>)">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                </div>
                <div class="combo-icon">
                    <i class="fa-solid fa-burger"></i>
                </div>
                <div class="combo-info">
                    <h3 class="combo-name">
                        <?php echo $combo['nombre']; ?>
                    </h3>
                    <p class="combo-desc">
                        <?php echo $combo['descripcion']; ?>
                    </p>
                    <div class="combo-price">$
                        <?php echo number_format($combo['precio'], 2); ?>
                    </div>
                </div>
                <div class="combo-footer">
                    <div class="combo-meta">

                        <span class="meta-item">
                            <i class="fa-solid fa-check-circle"></i> Vendidos:
                            <?php echo $combo['vendidos']; ?>
                        </span>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal: Nuevo/Editar Combo -->
<div class="modal" id="comboModal" style="display: none;">
    <div class="modal-overlay" onclick="closeComboModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Nuevo Combo</h3>
            <button class="modal-close" onclick="closeComboModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form onsubmit="handleComboSubmit(event)">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre del Combo *</label>
                    <input type="text" id="comboName" required placeholder="Ej: Super Pack Familiar">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea id="comboDesc" rows="3" placeholder="Detalles de lo que incluye..."></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Precio ($) *</label>
                        <input type="number" id="comboPrice" step="0.01" required placeholder="0.00">
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeComboModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Combo</button>
            </div>
        </form>
    </div>
</div>