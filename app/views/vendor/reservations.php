<div class="reservations-container">
    <!-- Header -->
    <div class="reservations-header">
        <div class="header-title">
            <h1>Mis Reservas</h1>
            <p>Gestiona los apartados temporales de productos para tus clientes.</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openReservationModal()">
                <i class="fa-solid fa-calendar-plus"></i>
                Nueva Reserva
            </button>
        </div>
    </div>

    <!-- Reservations Table -->
    <div class="table-card">
        <div class="table-responsive custom-scrollbar">
            <table class="reservations-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Evento</th>
                        <th>Combos Reservados</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td><span class="res-id">#<?php echo str_pad($res['id'], 3, '0', STR_PAD_LEFT); ?></span></td>
                            <td>
                                <div class="client-info">
                                    <div class="avatar-sm"><?php echo substr($res['cliente'], 0, 1); ?></div>
                                    <span class="name"><?php echo $res['cliente']; ?></span>
                                </div>
                            </td>
                            <td><?php echo $res['evento']; ?></td>
                            <td>
                                <div class="combos-list">
                                    <i class="fa-solid fa-box-open"></i>
                                    <?php echo $res['combos']; ?>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo $res['status']; ?>">
                                    <?php echo ucfirst($res['status']); ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="action-btns">
                                    <button class="btn-check" title="Confirmar Venta"><i
                                            class="fa-solid fa-check"></i></button>
                                    <button class="btn-cancel" title="Cancelar Reserva"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Nueva Reserva -->
<div class="modal" id="reservationModal" style="display: none;">
    <div class="modal-overlay" onclick="closeReservationModal()"></div>
    <div class="modal-content">
        <form onsubmit="handleResSubmit(event)">
            <div class="modal-header">
                <h3>Crear Nueva Reserva</h3>
                <button type="button" class="modal-close" onclick="closeReservationModal()"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre del Cliente *</label>
                    <input type="text" required placeholder="Nombre completo">
                </div>
                <div class="form-group">
                    <label>Evento *</label>
                    <select required>
                        <option value="">Seleccionar evento...</option>
                        <option value="1">Wendy's Fest</option>
                        <option value="2">Concierto Rock</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Seleccionar Combos *</label>
                    <div class="checkbox-group custom-scrollbar"
                        style="display: flex; flex-direction: column; gap: 0.75rem; max-height: 200px; overflow-y: auto; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 0.75rem; background: #f9fafb;">
                        <?php foreach ($combos as $combo): ?>
                            <label
                                style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; padding: 0.25rem; transition: all 0.2s;">
                                <input type="checkbox" name="combos[]" value="<?php echo $combo['id']; ?>"
                                    style="width: 1.1rem; height: 1.1rem; accent-color: #2b8cee; cursor: pointer;">
                                <div style="display: flex; flex-direction: column;">
                                    <span
                                        style="font-weight: 700; font-size: 14px; color: #374151;"><?php echo $combo['nombre']; ?></span>
                                    <span
                                        style="font-size: 12px; color: #6b7280;">$<?php echo number_format($combo['precio'], 2); ?></span>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <small style="color: #9ca3af; display: block; margin-top: 0.5rem;">Selecciona todos los combos que
                        el cliente desea reservar.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeReservationModal()">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Reserva</button>
            </div>
        </form>
    </div>
</div>