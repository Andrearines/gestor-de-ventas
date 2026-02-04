


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

    document.getElementById('memberModal').style.display = 'flex';

}
function closeMemberModal() {
    document.getElementById('memberModal').style.display = 'none';
}
function handleTeamSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);


    handleTeamCreate(formData)
    closeTeamModal();
    e.target.reset();
}


function handleTeamCreate(data) {

    const headers = {
        'Content-Type': 'application/json',
    };
    fetch('/api/teams/', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Equipo creado exitosamente');
                agregarTeam(data);
            } else {
                alert('Error al crear el equipo');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function agregarTeam(formData) {
    const data = Object.fromEntries(formData.entries());
    const teamData = {
        id: Date.now(), // ID temporal basado en timestamp
        nombre: data.nombre,
        evento: document.getElementById('teamEvent').options[document.getElementById('teamEvent').selectedIndex].text,
        miembros: Array.isArray(data.members) ? data.members.length : (data.members ? 1 : 0),
        ventas: 0.00,
        evento_id: data.evento_id,
        member_ids: Array.isArray(data.members) ? data.members.join(',') : (data.members ? data.members : '')
    };

    const teamList = document.getElementById('teams-list');
    const teamElement = document.createElement('tr');
    teamElement.id = 'team-' + teamData.id;
    teamElement.setAttribute('data-event-id', teamData.evento_id || '');
    teamElement.setAttribute('data-member-ids', teamData.member_ids || '');
    teamElement.innerHTML = `
        <td>
            <div class="team-cell">
                <div class="team-avatar">
                    ${teamData.nombre.substring(0, 2)}
                </div>
                <span class="team-name">
                    ${teamData.nombre}
                </span>
            </div>
        </td>
        <td>
            ${teamData.evento}
        </td>
        <td>
            <div class="members-badge">
                <i class="fa-solid fa-users"></i>
                ${teamData.miembros}
            </div>
        </td>
        <td>
            <span class="amount">$ ${parseFloat(teamData.ventas).toFixed(2)}</span>
        </td>
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
function RellenarModalTeam(id) {
    const teamRow = document.getElementById('team-' + id);
    if (!teamRow) return;

    // Extraer datos de la fila de la tabla
    const cells = teamRow.getElementsByTagName('td');
    const teamName = cells[0].querySelector('.team-name').textContent.trim();
    const eventText = cells[1].textContent.trim();
    const membersText = cells[2].textContent.trim();

    // Extraer el ID del evento del atributo data-event-id si existe, o usar el texto como fallback
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

    // Actualizar título del modal para edición
    document.querySelector('#memberModal .modal-header h3').textContent = 'Editar Miembro del Equipo';

    // Llenar campos del formulario
    document.getElementById('memberName').value = memberName;

    // Cambiar texto del botón de submit
    document.querySelector('#memberModal .btn-primary').textContent = 'Actualizar Miembro';

    // Almacenar ID del miembro para actualización
    document.getElementById('memberModal').setAttribute('data-member-id', id);
}
function handleMemberSubmit(e) {
    e.preventDefault();
    const name = document.getElementById('memberName').value;
    alert(`Miembro "${name}" creado exitosamente (Simulación)`);
    closeMemberModal();
    e.target.reset();
}