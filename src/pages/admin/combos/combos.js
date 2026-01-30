function openComboModal() {
    document.getElementById('modalTitle').innerText = 'Nuevo Combo';
    document.getElementById('comboModal').style.display = 'flex';
}

function closeComboModal() {
    document.getElementById('comboModal').style.display = 'none';
}

function handleComboSubmit(e) {
    e.preventDefault();
    alert('Combo guardado exitosamente (Simulación)');
    closeComboModal();
}

function editCombo(id) {
    document.getElementById('modalTitle').innerText = 'Editar Combo #' + id;
    document.getElementById('comboModal').style.display = 'flex';
    // Aquí se cargarían los datos reales
}