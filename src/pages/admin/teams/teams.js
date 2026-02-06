
// ==========================================
// MODALES
// ==========================================

function openTeamModal(id = null) {
    // Resetear el modal al estado de creación
    document.querySelector('#teamModal .modal-header h3').textContent = 'Nuevo Equipo de Ventas';
    document.querySelector('#teamModal .btn-primary').textContent = 'Crear Equipo';
    document.getElementById('teamModal').removeAttribute('data-team-id');

    // Resetear formulario
    document.querySelector('#teamModal form').reset();

    // Mostrar el modal
    document.getElementById('teamModal').style.display = 'flex';

    // Si hay un ID, es modo edición
    if (id) {
        RellenarModalTeam(id);
    }
}

function closeTeamModal() {
    document.getElementById('teamModal').style.display = 'none';
}

function openMemberModal(id = null) {
    // Resetear el modal al estado de creación
    document.querySelector('#memberModal .modal-header h3').textContent = 'Nuevo Miembro del Equipo';
    document.querySelector('#memberModal .btn-primary').textContent = 'Crear Miembro';
    document.getElementById('memberModal').removeAttribute('data-member-id');

    // Resetear formulario
    document.querySelector('#memberModal form').reset();

    // En modo creación, ocultar checkbox de cambiar contraseña y mostrar campo de contraseña
    const changePasswordCheckbox = document.getElementById('changePasswordCheckbox');
    const passwordFieldGroup = document.getElementById('passwordFieldGroup');
    const passwordField = document.getElementById('memberPassword');

    if (!id) {
        // Modo creación: ocultar checkbox, mostrar campo de contraseña y hacerlo requerido
        if (changePasswordCheckbox && changePasswordCheckbox.parentElement) {
            changePasswordCheckbox.parentElement.parentElement.style.display = 'none';
        }
        if (passwordFieldGroup) {
            passwordFieldGroup.style.display = 'block';
        }
        if (passwordField) {
            passwordField.required = true;
        }
    } else {
        // Modo edición: mostrar checkbox, ocultar campo de contraseña, no requerido
        if (changePasswordCheckbox && changePasswordCheckbox.parentElement) {
            changePasswordCheckbox.parentElement.parentElement.style.display = 'block';
            changePasswordCheckbox.checked = false;
        }
        if (passwordFieldGroup) {
            passwordFieldGroup.style.display = 'none';
        }
        if (passwordField) {
            passwordField.required = false;
        }
    }

    // Mostrar el modal
    document.getElementById('memberModal').style.display = 'flex';

    // Si hay un ID, es modo edición
    if (id) {
        RellenarModalMember(id);
    }
}

function closeMemberModal() {
    document.getElementById('memberModal').style.display = 'none';
}

function togglePasswordField() {
    const checkbox = document.getElementById('changePasswordCheckbox');
    const passwordGroup = document.getElementById('passwordFieldGroup');
    const passwordField = document.getElementById('memberPassword');

    if (checkbox && passwordGroup && passwordField) {
        if (checkbox.checked) {
            passwordGroup.style.display = 'block';
            passwordField.required = true;
        } else {
            passwordGroup.style.display = 'none';
            passwordField.required = false;
            passwordField.value = ''; // Limpiar el campo
        }
    }
}

// ==========================================
// RELLENAR MODALES (EDICIÓN)
// ==========================================

function RellenarModalTeam(id) {
    const teamRow = document.getElementById('team-' + id);
    if (!teamRow) return;

    // Extraer datos de la fila de la tabla
    const cells = teamRow.getElementsByTagName('td');
    const teamName = cells[0].querySelector('.team-name').textContent.trim();
    const eventText = cells[1].textContent.trim();

    // Extraer el ID del evento del atributo data-event-id
    let eventId = teamRow.getAttribute('data-event-id');
    if (!eventId) {
        // Si no hay data-event-id, buscar el evento por texto
        const eventSelect = document.getElementById('teamEvent');
        for (let i = 0; i < eventSelect.options.length; i++) {
            if (eventSelect.options[i].text.trim() === eventText.trim()) {
                eventId = eventSelect.options[i].value;
                break;
            }
        }
    }

    // Actualizar título del modal para edición
    document.querySelector('#teamModal .modal-header h3').textContent = 'Editar Equipo de Ventas';

    // Llenar campos del formulario
    document.getElementById('teamName').value = teamName;

    // Seleccionar el evento por ID
    if (eventId) {
        document.getElementById('teamEvent').value = eventId;
    }

    // Manejar los checkboxes de miembros
    // Primero limpiar todos los checkboxes
    document.querySelectorAll('input[name="members[]"]').forEach(checkbox => {
        checkbox.checked = false;
    });

    // Extraer IDs de miembros del atributo data-member-ids si existe
    const memberIds = teamRow.getAttribute('data-member-ids');
    if (memberIds) {
        const memberIdArray = memberIds.split(',').map(id => id.trim());
        memberIdArray.forEach(memberId => {
            const checkbox = document.getElementById(`m-${memberId}`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }

    // Cambiar texto del botón de submit
    document.querySelector('#teamModal .btn-primary').textContent = 'Actualizar Equipo';

    // Almacenar ID del equipo para actualización
    document.getElementById('teamModal').setAttribute('data-team-id', id);
}

function RellenarModalMember(id) {
    const memberRow = document.getElementById('miembro-' + id);
    if (!memberRow) return;

    // Extraer datos de la fila de la tabla
    const cells = memberRow.getElementsByTagName('td');
    const memberName = cells[0].querySelector('.team-name').textContent.trim();
    const teamName = cells[1].textContent.trim();
    const statusText = cells[2].textContent.trim();

    // Extraer username desde el atributo data-user (coincide con el modelo UserPHP)
    const username = memberRow.getAttribute('data-user');
    const teamId = memberRow.getAttribute('data-team-id');

    // Actualizar título del modal para edición
    document.querySelector('#memberModal .modal-header h3').textContent = 'Editar Miembro del Equipo';

    // Llenar campos del formulario
    document.getElementById('memberName').value = memberName;

    // Rellenar el username desde el atributo data
    if (username) {
        document.getElementById('user').value = username;
    }

    // Seleccionar el equipo por ID si existe
    const teamSelect = document.getElementById('memberTeam');
    if (teamSelect && teamId) {
        teamSelect.value = teamId;
    } else if (teamSelect) {
        // Fallback: buscar por nombre si no hay ID
        for (let i = 0; i < teamSelect.options.length; i++) {
            if (teamSelect.options[i].text.trim() === teamName.trim()) {
                teamSelect.selectedIndex = i;
                break;
            }
        }
    }

    // Seleccionar el estado
    const statusSelect = document.getElementById('memberStatus');
    if (statusSelect && statusText) {
        // Si el texto es "Activo", seleccionar valor 1, sino 0
        statusSelect.value = statusText.toLowerCase().includes('activo') ? '1' : '0';
    }

    // Cambiar texto del botón de submit
    document.querySelector('#memberModal .btn-primary').textContent = 'Actualizar Miembro';

    // Almacenar ID del miembro para actualización
    document.getElementById('memberModal').setAttribute('data-member-id', id);
}

// ==========================================
// SUBMIT HANDLERS
// ==========================================

function handleTeamSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const teamId = document.getElementById('teamModal').getAttribute('data-team-id');

    if (teamId) {
        // Modo edición
        handleTeamUpdate(teamId, formData);
    } else {
        // Modo creación
        handleTeamCreate(formData);
    }
}

function handleMemberSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const memberId = document.getElementById('memberModal').getAttribute('data-member-id');

    if (memberId) {
        // Modo edición
        handleMemberUpdate(memberId, formData);
    } else {
        // Modo creación
        handleMemberCreate(formData);
    }
}

// ==========================================
// MANIPULACIÓN DEL DOM
// ==========================================

function actualizarEstadisticas(tipo, operacion) {
    // tipo: 'equipos' o 'vendedores'
    // operacion: 'incrementar' o 'decrementar'
    const labelId = tipo === 'equipos' ? 'label-equipos' : 'label-vendedores';
    const label = document.getElementById(labelId);
    if (label) {
        const valorActual = parseInt(label.textContent) || 0;
        if (operacion === 'incrementar') {
            label.textContent = valorActual + 1;
        } else if (operacion === 'decrementar') {
            label.textContent = Math.max(0, valorActual - 1);
        }
    }
}

function agregarTeamAlDOM(teamData) {
    const teamList = document.getElementById('teams-list');
    const teamElement = document.createElement('tr');
    teamElement.id = 'team-' + teamData.id;
    teamElement.setAttribute('data-event-id', teamData.event_id || '');
    teamElement.setAttribute('data-member-ids', teamData.member_ids || '');

    // Obtener nombre del evento desde el select
    const eventSelect = document.getElementById('teamEvent');
    const eventOption = eventSelect.options[eventSelect.selectedIndex];
    const eventName = eventOption ? eventOption.text : 'Sin evento';

    teamElement.innerHTML = `
        <td>
            <div class="team-cell">
                <div class="team-avatar">
                    ${teamData.name.substring(0, 2).toUpperCase()}
                </div>
                <span class="team-name">
                    ${teamData.name}
                </span>
            </div>
        </td>
        <td>
            ${eventName}
        </td>
        <td>
            <div class="members-badge">
                <i class="fa-solid fa-users"></i>
                ${teamData.members_count || 0}
            </div>
        </td>
        <td><span class="amount">$ ${parseFloat(teamData.sales || 0).toFixed(2)}</span></td>
        <td class="text-right">
            <div class="action-group">
                <button class="icon-btn" title="Editar" onclick="openTeamModal(${teamData.id})">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="icon-btn danger" title="Desactivar" onclick="deleteTeam(${teamData.id})">
                    <i class="fa-solid fa-ban"></i>
                </button>
            </div>
        </td>
    `;
    teamList.appendChild(teamElement);
}

function actualizarTeamEnDOM(teamId, teamData) {
    const teamRow = document.getElementById('team-' + teamId);
    if (!teamRow) return;

    // Actualizar atributos data
    teamRow.setAttribute('data-event-id', teamData.event_id || '');
    teamRow.setAttribute('data-member-ids', teamData.member_ids || '');

    // Obtener nombre del evento
    const eventSelect = document.getElementById('teamEvent');
    const eventOption = eventSelect.options[eventSelect.selectedIndex];
    const eventName = eventOption ? eventOption.text : 'Sin evento';

    const cells = teamRow.getElementsByTagName('td');

    // Actualizar nombre del equipo
    const nameSpan = cells[0].querySelector('.team-name');
    if (nameSpan) nameSpan.textContent = teamData.name;

    // Actualizar avatar
    const avatar = cells[0].querySelector('.team-avatar');
    if (avatar) avatar.textContent = teamData.name.substring(0, 2).toUpperCase();

    // Actualizar evento
    if (cells[1]) cells[1].textContent = eventName;

    // Actualizar número de miembros
    const membersBadge = cells[2].querySelector('.members-badge');
    if (membersBadge) {
        membersBadge.innerHTML = `<i class="fa-solid fa-users"></i> ${teamData.members_count || 0}`;
    }
}

function eliminarTeamDelDOM(teamId) {
    const teamRow = document.getElementById('team-' + teamId);
    if (teamRow) {
        teamRow.remove();
    }
}

function agregarMiembroAlDOM(memberData) {
    const memberList = document.getElementById('miembros-list');
    const memberElement = document.createElement('tr');
    memberElement.id = 'miembro-' + memberData.id;
    memberElement.setAttribute('data-username', memberData.username || '');
    memberElement.setAttribute('data-team-id', memberData.team_id || '');

    memberElement.innerHTML = `
        <td>
            <div class="team-cell">
                <div class="team-avatar">
                    ${(memberData.name || 'MI').substring(0, 2).toUpperCase()}
                </div>
                <span class="team-name">
                    ${memberData.name || 'Sin nombre'}
                </span>
            </div>
        </td>
        <td>
            ${memberData.team_names_string || 'Sin equipo'}
        </td>
        <td>
            <span class="status-badge">
                ${memberData.active == 1 ? 'Activo' : 'Inactivo'}
            </span>
        </td>
        <td><span class="amount">$ ${parseFloat(memberData.total_sales || 0).toFixed(2)}</span></td>
        <td class="text-right">
            <div class="action-group">
                <button class="icon-btn" title="Editar" onclick="openMemberModal(${memberData.id})">
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
    `;
    memberList.appendChild(memberElement);
}

function actualizarMiembroEnDOM(memberId, memberData) {
    const memberRow = document.getElementById('miembro-' + memberId);
    if (!memberRow) return;

    // Actualizar atributos data
    if (memberData.user) {
        memberRow.setAttribute('data-user', memberData.user);
    }
    if (memberData.team_id) {
        memberRow.setAttribute('data-team-id', memberData.team_id);
    }

    const cells = memberRow.getElementsByTagName('td');

    // Actualizar nombre
    const nameSpan = cells[0].querySelector('.team-name');
    if (nameSpan && memberData.name) nameSpan.textContent = memberData.name;

    // Actualizar avatar
    const avatar = cells[0].querySelector('.team-avatar');
    if (avatar && memberData.name) avatar.textContent = memberData.name.substring(0, 2).toUpperCase();

    // Actualizar equipo
    if (cells[1] && memberData.team_names_string) cells[1].textContent = memberData.team_names_string;

    // Actualizar estado
    const statusBadge = cells[2].querySelector('.status-badge');
    if (statusBadge && memberData.active !== undefined) {
        statusBadge.textContent = memberData.active == 1 ? 'Activo' : 'Inactivo';
    }
}

function eliminarMiembroDelDOM(memberId) {
    const memberRow = document.getElementById('miembro-' + memberId);
    if (memberRow) {
        memberRow.remove();
    }
}



// ==========================================
// API - TEAMS
// ==========================================

function handleTeamCreate(formData) {
    fetch('/api/teams/create', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notify('Creado', 'El equipo se creó exitosamente', 'success', 2000);
                closeTeamModal();

                // Agregar equipo al DOM dinámicamente
                const selectedMembers = formData.getAll('members[]');
                agregarTeamAlDOM({
                    id: data.team_id,
                    name: formData.get('name'),
                    event_id: formData.get('event_id'),
                    member_ids: selectedMembers.join(','),
                    members_count: selectedMembers.length,
                    sales: 0
                });

                // Actualizar estadística
                actualizarEstadisticas('equipos', 'incrementar');

                // Sincronizar nombres de equipos en miembros
                actualizarMiembrosDesdeEquipos();
            } else {
                notify('Error', data.error || 'El equipo no se pudo crear', 'error', 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notify('Error', 'El equipo no se pudo crear', 'error', 2000);
        });
}

function handleTeamUpdate(teamId, formData) {
    formData.append('id', teamId);

    fetch('/api/teams/update', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notify('Actualizado', 'El equipo se actualizó exitosamente', 'success', 2000);
                closeTeamModal();

                const selectedMembers = formData.getAll('members[]');

                // Actualizar equipo en el DOM
                actualizarTeamEnDOM(teamId, {
                    name: formData.get('name'),
                    event_id: formData.get('event_id'),
                    member_ids: selectedMembers.join(','),
                    members_count: selectedMembers.length
                });

                // Sincronizar nombres de equipos en miembros
                actualizarMiembrosDesdeEquipos();
            } else {
                notify('Error', data.error || 'El equipo no se pudo actualizar', 'error', 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notify('Error', 'El equipo no se pudo actualizar', 'error', 2000);
        });
}

function deleteTeam(teamId) {
    if (!confirm('¿Estás seguro de que deseas eliminar este equipo?')) {
        return;
    }

    const formData = new FormData();
    formData.append('id', teamId);

    fetch('/api/teams/delete', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notify('Eliminado', 'El equipo se eliminó exitosamente', 'success', 2000);
                eliminarTeamDelDOM(teamId);
                actualizarEstadisticas('equipos', 'decrementar');
            } else {
                notify('Error', 'El equipo no se pudo eliminar', 'error', 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notify('Error', 'El equipo no se pudo eliminar', 'error', 2000);
        });
}

// ==========================================
// API - MEMBERS
// ==========================================

function handleMemberCreate(formData) {
    fetch('/api/members/create', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notify('Creado', 'El miembro se creó exitosamente', 'success', 2000);
                closeMemberModal();

                // Obtener nombre del equipo
                const teamSelect = document.getElementById('memberTeam');
                const teamName = teamSelect.options[teamSelect.selectedIndex].text;

                agregarMiembroAlDOM({
                    id: data.id,
                    name: formData.get('name'),
                    username: formData.get('username'),
                    team_id: formData.get('team_id'),
                    team_name: teamName,
                    active: formData.get('active'),
                    total_sales: 0
                });
                actualizarEstadisticas('vendedores', 'incrementar');
            } else {
                notify('Error', 'El miembro no se pudo crear', 'error', 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notify('Error', 'El miembro no se pudo crear', 'error', 2000);
        });
}

function handleMemberUpdate(memberId, formData) {
    formData.append('id', memberId);

    // Si no se marcó "Cambiar contraseña", eliminar el campo password
    const changePasswordCheckbox = document.getElementById('changePasswordCheckbox');
    if (changePasswordCheckbox && !changePasswordCheckbox.checked) {
        formData.delete('password');
    }

    fetch('/api/members/update', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notify('Actualizado', 'El miembro se actualizó exitosamente', 'success', 2000);
                closeMemberModal();

                // Obtener nombre del equipo
                const teamSelect = document.getElementById('memberTeam');
                const teamName = teamSelect.options[teamSelect.selectedIndex].text;

                actualizarMiembroEnDOM(memberId, {
                    name: formData.get('name'),
                    username: formData.get('username'),
                    team_id: formData.get('team_id'),
                    team_name: teamName,
                    active: formData.get('active')
                });
            } else {
                notify('Error', 'El miembro no se pudo actualizar', 'error', 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notify('Error', 'El miembro no se pudo actualizar', 'error', 2000);
        });
}

function deleteMember(memberId) {
    if (!confirm('¿Estás seguro de que deseas eliminar este miembro?')) {
        return;
    }

    const formData = new FormData();
    formData.append('id', memberId);

    fetch('/api/members/delete', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notify('Eliminado', 'El miembro se eliminó exitosamente', 'success', 2000);
                eliminarMiembroDelDOM(memberId);
                actualizarEstadisticas('vendedores', 'decrementar');
            } else {
                notify('Error', 'El miembro no se pudo eliminar', 'error', 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            notify('Error', 'El miembro no se pudo eliminar', 'error', 2000);
        });
}

function actualizarMiembrosDesdeEquipos() {
    // Esta función recorre todos los equipos en el DOM y reconstruye el mapa de miembros-equipos
    // para actualizar la columna "Grupo" en la tabla de miembros sin recargar.

    const teamRows = document.querySelectorAll('#teams-list tr');
    const memberTeamsMap = {}; // userId -> [teamNames]
    const teamNamesMap = {}; // teamId -> teamName

    teamRows.forEach(row => {
        const teamId = row.id.replace('team-', '');
        const teamName = row.querySelector('.team-name').textContent.trim();
        const memberIds = row.getAttribute('data-member-ids');

        teamNamesMap[teamId] = teamName;

        if (memberIds) {
            memberIds.split(',').forEach(uid => {
                const userId = uid.trim();
                if (userId) {
                    if (!memberTeamsMap[userId]) memberTeamsMap[userId] = [];
                    memberTeamsMap[userId].push(teamName);
                }
            });
        }
    });

    // Actualizar cada fila de la tabla de miembros
    const memberRows = document.querySelectorAll('#miembros-list tr');
    memberRows.forEach(row => {
        const userId = row.id.replace('miembro-', '');
        const groupCell = row.cells[1];
        if (groupCell) {
            const teamNames = memberTeamsMap[userId];
            groupCell.textContent = teamNames && teamNames.length > 0 ? teamNames.join(', ') : 'Sin equipo';
        }
    });
}