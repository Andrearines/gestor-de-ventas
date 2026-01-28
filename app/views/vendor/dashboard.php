<!-- Datos ocultos de PHP para el JS -->
<input type="hidden" id="php-vendor-stats" value='<?php echo json_encode($stats ?? []); ?>'>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Hola, Vendedor</h1>
            <p class="text-gray-500">Este es el resumen de tu actividad para el evento actual.</p>
        </div>
        <a href="/vendor/sales"
            class="btn btn-primary flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
            <i class="fa-solid fa-plus"></i>
            Registrar Venta
        </a>
    </div>

    <!-- TARJETAS DE MÉTRICAS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Recaudado</p>
                <h3 class="text-3xl font-black text-gray-900">$
                    <?php echo number_format($stats['mis_ventas'] ?? 0, 2); ?>
                </h3>
            </div>
            <i
                class="fa-solid fa-sack-dollar absolute -right-2 -bottom-2 text-6xl text-gray-50 group-hover:text-green-50 transition-colors"></i>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Boletos por Vender</p>
                <h3 class="text-3xl font-black text-gray-900">
                    <?php echo $stats['boletos_pendientes'] ?? 0; ?>
                </h3>
            </div>
            <i
                class="fa-solid fa-ticket absolute -right-2 -bottom-2 text-6xl text-gray-50 group-hover:text-blue-50 transition-colors"></i>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Reservas</p>
                <h3 class="text-3xl font-black text-gray-900">
                    <?php echo $stats['reservas_activas'] ?? 0; ?>
                </h3>
            </div>
            <i
                class="fa-solid fa-clock-rotate-left absolute -right-2 -bottom-2 text-6xl text-gray-50 group-hover:text-yellow-50 transition-colors"></i>
        </div>
    </div>

    <!-- RECOMENDACIONES O ACCIONES RÁPIDAS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-8 rounded-2xl border border-gray-200">
            <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-primary"></i>
                Próximos Pasos
            </h4>
            <ul class="space-y-4">
                <li
                    class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer">
                    <div
                        class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary shrink-0">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Finalizar reservas</p>
                        <p class="text-xs text-gray-500">Tienes 5 reservas que vencen pronto.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>