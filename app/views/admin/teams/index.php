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
            <span class="value" id="label-equipos"><?php echo count($teams); ?></span>
        </div>
        <div class="overview-item">
            <span class="label">Vendedores Activos</span>
            <span class="value" id="label-vendedores"><?php echo count($users); ?></span>
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
                        <tr id="team-<?php echo $team->id; ?>" data-event-id="<?php echo $team->event_id; ?>"
                            data-member-ids="<?php echo isset($team_membres[$team->id]) ? implode(',', $team_membres[$team->id]) : ''; ?>">
                            <td>
                                <div class="team-cell">
                                    <div class="team-avatar">
                                        <?php echo substr($team->name, 0, 2); ?>
                                    </div>
                                    <span class="team-name">
                                        <?php echo $team->name; ?>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <?php
                                // Obtener nombre del evento
                                $event = array_filter($events, function ($e) use ($team) {
                                    return $e->id == $team->event_id;
                                });
                                $event = reset($event);
                                echo $event ? $event->name : 'Evento no encontrado';
                                ?>
                            </td>
                            <td>
                                <div class="members-badge">
                                    <i class="fa-solid fa-users"></i>
                                    <?php echo $team->members; ?>
                                </div>
                            </td>
                            <td><span class="amount">$
                                    <?php echo number_format($team->sales, 2); ?>
                                </span></td>
                            <td class="text-right">
                                <div class="action-group">
                                    <button class="icon-btn" title="Editar"
                                        onclick="openTeamModal(<?php echo $team->id; ?>)"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="icon-btn danger" title="Desactivar"
                                        onclick="deleteTeam(<?php echo $team->id; ?>)"><i
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
                        <tr id="miembro-<?php echo $user->id; ?>" data-user="<?php echo $user->user ?? ''; ?>"
                            data-team-id="<?php echo $user->team_id ?? ''; ?>">
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
                                <?php echo $user->team_names_string ?? 'Sin equipo'; ?>
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
                                        onclick="openMemberModal(<?php echo $user->id; ?>)">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="icon-btn danger" title="Desactivar">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                    <button class="icon-btn danger" title="Eliminar">
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
                    <input type="text" name="name" id="teamName" required placeholder="Ej: Zona Norte Force">
                </div>
                <div class="form-group">
                    <label>Asociar a Evento *</label>
                    <select name="event_id" id="teamEvent" required>
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
                    <input type="text" name="username" id="user" required placeholder="nombre de usuario">
                </div>
                <div class="form-group">
                    <label>Nombre del Miembro *</label>
                    <input type="text" name="name" id="memberName" required placeholder="Nombre completo">
                </div>
                <div class="form-group">
                    <label>
                        Cambiar contraseña
                    </label>
                    <input type="checkbox" id="changePasswordCheckbox" onchange="togglePasswordField()">
                </div>
                <div class="form-group" id="passwordFieldGroup" style="display: none;">
                    <label>Contraseña *</label>
                    <input type="password" name="password" id="memberPassword" placeholder="Nueva contraseña">
                </div>
                <div class="form-group">
                    <label>Asignar a Equipo</label>
                    <select name="team_id" id="memberTeam">
                        <option value="">Sin equipo</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado *</label>
                    <select name="active" id="memberStatus" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeMemberModal()">Cancelar</button>
                <button type=" submit" class="btn btn-primary">Guardar Miembro</button>
            </div>
        </form>
    </div>
</div>