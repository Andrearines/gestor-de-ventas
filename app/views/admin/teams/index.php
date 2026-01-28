<div class="teams-container">
    <!-- Header -->
    <div class="teams-header">
        <div class="header-title">
            <h1>Gestión de Equipos</h1>
            <p>Supervisa y organiza a los grupos de vendedores y sus metas.</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary" onclick="openMemberModal()">
                <i class="fa-solid fa-user-plus"></i>
                Añadir Miembro
            </button>
            <button class="btn btn-primary" onclick="openTeamModal()">
                <i class="fa-solid fa-users-plus"></i>
                Crear Equipo
            </button>
        </div>
    </div>

    <!-- Stats summary -->
    <div class="teams-overview">
        <div class="overview-item">
            <span class="label">Equipos Totales</span>
            <span class="value">15</span>
        </div>
        <div class="overview-item">
            <span class="label">Vendedores Activos</span>
            <span class="value">84</span>
        </div>
        <div class="overview-item">
            <span class="label">Meta Cumplida</span>
            <span class="value">72%</span>
        </div>
    </div>

    <!-- Teams Table -->
    <div class="table-card">
        <div class="card-header">
            <h3>Listado de Equipos de Venta</h3>
        </div>
        <div class="table-responsive">
            <table class="teams-table">
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Evento Asociado</th>
                        <th>Miembros</th>
                        <th>Ventas Acumuladas</th>
                        <th>Incentivo</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teams as $team): ?>
                        <tr>
                            <td>
                                <div class="team-cell">
                                    <div class="team-avatar">
                                        <?php echo substr($team['nombre'], 0, 2); ?>
                                    </div>
                                    <span class="team-name">
                                        <?php echo $team['nombre']; ?>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <?php echo $team['evento']; ?>
                            </td>
                            <td>
                                <div class="members-badge">
                                    <i class="fa-solid fa-users"></i>
                                    <?php echo $team['miembros']; ?>
                                </div>
                            </td>
                            <td><span class="amount">$
                                    <?php echo number_format($team['ventas'], 2); ?>
                                </span></td>
                            <td><span class="bonus">+$
                                    <?php echo number_format($team['incentivo'], 2); ?>
                                </span></td>
                            <td>
                                <span class="status-pill status-<?php echo $team['status']; ?>">
                                    <?php echo $team['status'] === 'en_pausa' ? 'En Pausa' : 'Activo'; ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="action-group">
                                    <button class="icon-btn" title="Editar"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="icon-btn danger" title="Desactivar"><i
                                            class="fa-solid fa-ban"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Registro de Equipo -->
<div class="modal" id="teamModal" style="display: none;">
    <div class="modal-overlay" onclick="closeTeamModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Nuevo Equipo de Ventas</h3>
            <button class="modal-close" onclick="closeTeamModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form onsubmit="handleTeamSubmit(event)">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre del Equipo *</label>
                    <input type="text" required placeholder="Ej: Zona Norte Force">
                </div>
                <div class="form-group">
                    <label>Asociar a Evento *</label>
                    <select required>
                        <option value="">Seleccionar evento...</option>
                        <?php foreach ($events as $event): ?>
                            <option value="<?php echo $event['id']; ?>"><?php echo $event['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="form-help">Nota: El creador del evento actuará como administrador/líder del equipo.</p>
                </div>

                <div class="form-group">
                    <label>Seleccionar Miembros del Equipo</label>
                    <div class="members-selection-list">
                        <?php foreach ($members as $member): ?>
                            <div class="member-checkbox-item">
                                <input type="checkbox" id="m-<?php echo $member['id']; ?>" name="members[]"
                                    value="<?php echo $member['id']; ?>">
                                <label for="m-<?php echo $member['id']; ?>">
                                    <span class="member-name"><?php echo $member['nombre']; ?></span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción de Objetivos</label>
                    <textarea rows="2" placeholder="Describe las metas de este equipo..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeTeamModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear Equipo</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Registro de Miembro -->
<div class="modal" id="memberModal" style="display: none;">
    <div class="modal-overlay" onclick="closeMemberModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Nuevo Miembro del Equipo</h3>
            <button class="modal-close" onclick="closeMemberModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form onsubmit="handleMemberSubmit(event)">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre del Miembro *</label>
                    <input type="text" id="memberName" required placeholder="Nombre completo">
                </div>
                <div class="form-group">
                    <label>Contraseña *</label>
                    <input type="password" id="memberPassword" required placeholder="Asignar contraseña">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeMemberModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Miembro</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTeamModal() {
        document.getElementById('teamModal').style.display = 'flex';
    }
    function closeTeamModal() {
        document.getElementById('teamModal').style.display = 'none';
    }
    function openMemberModal() {
        document.getElementById('memberModal').style.display = 'flex';
    }
    function closeMemberModal() {
        document.getElementById('memberModal').style.display = 'none';
    }
    function handleTeamSubmit(e) {
        e.preventDefault();
        alert('Equipo creado exitosamente (Simulación)');
        closeTeamModal();
    }
    function handleMemberSubmit(e) {
        e.preventDefault();
        const name = document.getElementById('memberName').value;
        alert(`Miembro "${name}" creado exitosamente (Simulación)`);
        closeMemberModal();
        e.target.reset();
    }
</script>