
function filterInventory() {
    const searchInput = document.getElementById('inventorySearch');
    if (!searchInput) return;

    const search = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('#inventoryTable tbody tr');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
}

function openGenerateModal() {
    const modal = document.getElementById('generateModal');
    if (modal) modal.style.display = 'flex';
}

function closeGenerateModal() {
    const modal = document.getElementById('generateModal');
    if (modal) modal.style.display = 'none';
}


function handleGenerate(e) {
    e.preventDefault();
    alert('Rango generado exitosamente (Simulación)');
    closeGenerateModal();
}

function exportInventory() {
    alert('Exportando inventario a Excel... (Simulación)');
}

// Lógica de Dropdowns Personalizados
document.addEventListener('DOMContentLoaded', () => {
    const dropdowns = document.querySelectorAll('.custom-dropdown');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const content = dropdown.querySelector('.dropdown-content');
        const items = dropdown.querySelectorAll('.dropdown-item');

        if (!toggle || !content) return;

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();

            // Cerrar otros dropdowns abiertos
            document.querySelectorAll('.dropdown-content.show').forEach(openContent => {
                if (openContent !== content) openContent.classList.remove('show');
            });
            document.querySelectorAll('.dropdown-toggle.active').forEach(activeToggle => {
                if (activeToggle !== toggle) activeToggle.classList.remove('active');
            });

            content.classList.toggle('show');
            toggle.classList.toggle('active');
        });

        items.forEach(item => {
            item.addEventListener('click', () => {
                const value = item.dataset.value;
                const text = item.innerText.trim();
                const ticketId = dropdown.dataset.ticketId;

                // Actualizar interfaz
                const span = toggle.querySelector('span');
                if (span) span.innerText = text;

                items.forEach(i => i.classList.remove('selected'));
                item.classList.add('selected');

                content.classList.remove('show');
                toggle.classList.remove('active');

                // Notificación o llamada API (Simulación)
                console.log(`Boleto ${ticketId} asignado a: ${value || 'nadie'}`);
            });
        });
    });

    // Cerrar al hacer clic fuera
    window.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-content.show').forEach(content => {
            content.classList.remove('show');
        });
        document.querySelectorAll('.dropdown-toggle.active').forEach(toggle => {
            toggle.classList.remove('active');
        });
    });
});

// Función para cambiar estado (solicitada en la vista)
function changeStatus(id, currentStatus) {
    console.log(`Cambiando estado del boleto ${id}. Estado actual: ${currentStatus}`);
    // Aquí puedes implementar una lógica para rotar estados o abrir un modal
}
