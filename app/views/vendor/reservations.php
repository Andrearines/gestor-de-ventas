<div class="reservations-container">
    <!-- Header -->
    <div class="reservations-header">
        <div class="header-title">
            <h1>Mis Reservas</h1>
            <p>Gestiona los apartados temporales de boletos para tus clientes.</p>
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
        <div class="table-responsive">
            <table class="reservations-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Boletos</th>
                        <th>Evento</th>
                        <th>Expira en</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td><span class="res-id">#
                                    <?php echo str_pad($res['id'], 3, '0', STR_PAD_LEFT); ?>
                                </span></td>
                            <td>
                                <div class="client-info">
                                    <div class="avatar-sm">
                                        <?php echo substr($res['cliente'], 0, 1); ?>
                                    </div>
                                    <span class="name">
                                        <?php echo $res['cliente']; ?>
                                    </span>
                                </div>
                            </td>
                            <td><span class="count">
                                    <?php echo $res['boletos']; ?> boletos
                                </span></td>
                            <td>
                                <?php echo $res['evento']; ?>
                            </td>
                            <td>
                                <div class="expiry">
                                    <i class="fa-regular fa-clock"></i>
                                    <?php echo $res['expira']; ?>
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
        <div class="modal-header">
            <h3>Crear Nueva Reserva</h3>
            <button class="modal-close" onclick="closeReservationModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form onsubmit="handleResSubmit(event)">
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
                <div class="form-row">
                    <div class="form-group">
                        <label>Cantidad de Boletos *</label>
                        <input type="number" min="1" max="10" required value="1">
                    </div>
                    <div class="form-group">
                        <label>Tiempo de Reserva (Horas)</label>
                        <input type="number" min="1" max="48" value="24">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeReservationModal()">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Reserva</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReservationModal() {
        document.getElementById('reservationModal').style.display = 'flex';
    }
    function closeReservationModal() {
        document.getElementById('reservationModal').style.display = 'none';
    }
    function handleResSubmit(e) {
        e.preventDefault();
        alert('Reserva creada exitosamente (Simulación)');
        closeReservationModal();
    }
</script>