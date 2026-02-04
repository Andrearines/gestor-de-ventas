
// Variables globales
let eventIdToDelete = null;

// Toggle filtros
function toggleFilters() {
    const panel = document.getElementById('filtersPanel');
    if (panel) {
        panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    }
}

// Aplicar filtros
function applyFilters() {
    const statusSelect = document.getElementById('filterStatus');
    const dateInput = document.getElementById('filterDate');
    const searchInput = document.getElementById('filterSearch');

    if (!statusSelect || !dateInput || !searchInput) return;

    const status = statusSelect.value.toLowerCase();
    const date = dateInput.value;
    const search = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('#eventsTable tbody tr');

    rows.forEach(row => {
        const rowStatus = row.dataset.status ? row.dataset.status.toLowerCase() : '';
        const rowDate = row.dataset.date || '';
        const rowText = row.textContent.toLowerCase();

        const matchStatus = !status || rowStatus === status;
        const matchDate = !date || rowDate === date;
        const matchSearch = !search || rowText.includes(search);

        row.style.display = matchStatus && matchDate && matchSearch ? '' : 'none';
    });
}


// Editar evento
function editEvent(id) {
    window.location.href = `/admin/events/edit?id=${id}`;
}

// Confirmar eliminación
function confirmDelete(id, name) {
    eventIdToDelete = id;
    const nameEl = document.getElementById('eventNameToDelete');
    if (nameEl) nameEl.textContent = name;

    const modal = document.getElementById('deleteModal');
    if (modal) modal.style.display = 'flex';
}

// Cerrar modal
function closeDeleteModal() {
    eventIdToDelete = null;
    const modal = document.getElementById('deleteModal');
    if (modal) modal.style.display = 'none';
}

// Eliminar evento
function deleteEvent() {
    if (!eventIdToDelete) return;

    fetch(`/api/events/delete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }, body: JSON.stringify({
            id: eventIdToDelete
        })

    })
        .then(response => response.json())
        .then(data => {
            if (data.success === true) {
                window.location.href = '/admin/events?deleted=1';
            } else {
                notify("error", data.error);
            }
        })
        .catch(error => {

            notify("error", "Error al eliminar el evento");
        });

    closeDeleteModal();
}

// Auto-ocultar alertas después de 5 segundos
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
