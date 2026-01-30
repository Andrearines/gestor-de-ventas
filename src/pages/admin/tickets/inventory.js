
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
