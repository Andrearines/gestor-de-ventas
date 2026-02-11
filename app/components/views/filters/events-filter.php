<!-- Filtros (ocultos por defecto) -->
<div class="filters-panel" id="filtersPanel" style="display: none;">
    <div class="filters-grid">
        <div class="filter-group">
            <label>Estado</label>
            <select id="filterStatus" onchange="applyFilters()">
                <option value="">Todos</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Fecha</label>
            <input type="date" id="filterDate" onchange="applyFilters()">
        </div>
        <div class="filter-group">
            <label>Búsqueda</label>
            <input type="text" id="filterSearch" placeholder="Buscar evento..." oninput="applyFilters()">
        </div>
    </div>
</div>