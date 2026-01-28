<!-- Datos ocultos de PHP para el JS -->
<input type="hidden" id="php-stats" value='<?php echo json_encode($stats ?? []); ?>'>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Bienvenido, Administrador</h1>
            <p class="text-gray-500">Resumen de actividad y métricas clave.</p>
        </div>
        <div class="flex gap-4">
            <button
                class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-download"></i>
                Exportar Reporte
            </button>
            <a href="/admin/events/create"
                class="flex items-center gap-2 px-6 py-2 bg-primary text-white rounded-xl text-sm font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                <i class="fa-solid fa-plus"></i>
                Nuevo Evento
            </a>
        </div>
    </div>
    <!-- Secciones adicionales como gráficos o tablas recientes irán aquí -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div
            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm min-h-[300px] flex items-center justify-center text-gray-400 italic">
            Zona para gráfico de ventas (Chart.js)
        </div>
        <div
            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm min-h-[300px] flex items-center justify-center text-gray-400 italic">
            Zona para tabla de actividad reciente
        </div>
    </div>
</div>