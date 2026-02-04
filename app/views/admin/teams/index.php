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
            <span class="value" id="label-equipos">15</span>
        </div>
        <div class="overview-item">
            <span class="label">Vendedores Activos</span>
            <span class="value" id="label-vendedores">84</span>
        </div>

        <div class="overview-item">
            <span class="label">Vendedores inactivos</span>
            <span class="value" id="lebel-inactivos">84</span>
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
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody id="teams-list">
                    <!--js-->
                    <?php foreach ($teams as $team): ?>
                        <tr id="team-<?php echo $team['id']; ?>" data-event-id="<?php echo $team['evento_id']; ?>"
                            data-member-ids="<?php echo isset($team['member_ids']) ? $team['member_ids'] : ''; ?>">
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
                                    <input type="hidden" name="member_ids" value="<?php echo $team['member_ids']; ?>">
                                </div>
                            </td>
                            <td><span class="amount">$
                                    <?php echo number_format($team['ventas'], 2); ?>
                                </span></td>
                            <td class="text-right">
                                <div class="action-group">
                                    <button class="icon-btn" title="Editar"
                                        onclick="openTeamModal(<?php echo $team['id']; ?>)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="icon-btn danger" title="Desactivar"
                                        onclick="deleteTeam(<?php echo $team['id']; ?>)"><i
                                            class="fa-solid fa-ban"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <!--miembros-->
    <div class="table-card">
        <div class="card-header">
            <h3>Listado de miembros de Venta</h3>
        </div>
        <div class="table-responsive">
            <table class="teams-table">
                <thead>
                    <tr>
                        <th>nombre</th>
                        <th>grupo</th>
                        <th>stado</th>
                        <th>Ventas Acumuladas</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody id="miembros-list">
                    <!--js-->
                    <?php foreach ($users as $user): ?>
                        <tr id="miembro-<?php echo $user->id; ?>">
                            <td>
                                <div class="team-cell">
                                    <div class="team-avatar">
                                        <?php echo substr($user->name ?? 'MI', 0, 2); ?>
                                    </div>
                                    <span class="team-name">
                                        <?php echo $user->name ?? 'Sin nombre'; ?>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <?php echo $user->team_name ?? 'Sin equipo'; ?>
                            </td>
                            <td>
                                <span class="status-badge ">
                                    <?php echo $user->active == 1 ? 'Activo' : 'Inactivo'; ?>
                                </span>
                            </td>
                            <td><span class="amount">$
                                    <?php echo number_format($user->total_sales ?? 0, 2); ?>
                                </span></td>
                            <td class="text-right">
                                <div class="action-group">
                                    <button class="icon-btn" title="Editar"
                                        onclick="openMemberModal(<?php echo $member->id; ?>)">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="icon-btn danger" title="Desactivar">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Registro de teams -->
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
                    <input type="text" name="nombre" id="teamName" required placeholder="Ej: Zona Norte Force">
                </div>
                <div class="form-group">
                    <label>Asociar a Evento *</label>
                    <select name="evento_id" id="teamEvent" required>
                        <option value="">Seleccionar evento...</option>
                        <?php foreach ($events as $event): ?>
                            <option value="<?php echo $event->id; ?>"><?php echo $event->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="form-help">Nota: El creador del evento actuará como administrador/líder del equipo.</p>
                </div>

                <div class="form-group">
                    <label>Seleccionar Miembros del Equipo</label>
                    <div class="members-selection-list">
                        <?php foreach ($users as $user): ?>
                            <div class="member-checkbox-item">
                                <input type="checkbox" id="m-<?php echo $user->id; ?>" name="members[]"
                                    value="<?php echo $user->id; ?>">
                                <label for="m-<?php echo $user->id; ?>">
                                    <span class="member-name"><?php echo $user->name; ?></span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
                    <label>Nombre de usuario *</label>
                    <input type="text" id="user" required placeholder="nombre de usuario">
                </div>
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
                <button type=" submit" class="btn btn-primary">Guardar Miembro</button>
            </div>
        </form>
    </div>
</div>