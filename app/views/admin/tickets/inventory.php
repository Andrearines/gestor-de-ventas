<!-- Datos ocultos de PHP para el JS -->
<input type="hidden" id="php-tickets" value='<?php echo json_encode($tickets ?? []); ?>'>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Inventario de Boletos</h1>
            <p class="text-gray-500">Control individual y auditoría de boletos físicos por evento.</p>
        </div>
        <div class="flex gap-3">
            <button
                class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-file-export"></i>
                Exportar Inventario
            </button>
            <button
                class="flex items-center gap-2 px-6 py-2 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                <i class="fa-solid fa-plus"></i>
                Generar Rango de Boletos
            </button>
        </div>
    </div>

    <!-- Resumen de Inventario -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
            <p class="text-xs font-bold text-blue-600 uppercase">Total Boletos</p>
            <h4 class="text-xl font-bold text-blue-900 mt-1">5,000</h4>
        </div>
        <div class="bg-green-50 p-4 rounded-xl border border-green-100">
            <p class="text-xs font-bold text-green-600 uppercase">Vendidos</p>
            <h4 class="text-xl font-bold text-green-900 mt-1">1,240</h4>
        </div>
        <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100">
            <p class="text-xs font-bold text-yellow-600 uppercase">Disponibles</p>
            <h4 class="text-xl font-bold text-yellow-900 mt-1">3,650</h4>
        </div>
        <div class="bg-red-50 p-4 rounded-xl border border-red-100">
            <p class="text-xs font-bold text-red-600 uppercase">Perdidos / Faltantes</p>
            <h4 class="text-xl font-bold text-red-900 mt-1">10</h4>
        </div>
    </div>

    <!-- Tabla de Inventario Detallado -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <h3 class="font-bold text-gray-700">Listado de Boletos</h3>
            <div class="flex gap-2">
                <div class="relative">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Buscar boleto #..."
                        class="pl-9 pr-4 py-1.5 bg-white border border-gray-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-primary/20">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase"># Boleto</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Evento</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Vendedor Asignado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Estado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($tickets as $ticket): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-primary">#
                                <?php echo $ticket['numero']; ?>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <?php echo $ticket['evento']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-user-tag text-gray-300 text-xs"></i>
                                    <span class="text-sm font-medium">
                                        <?php echo $ticket['vendedor']; ?>
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php
                                $statusColor = match ($ticket['status']) {
                                    'Vendido' => 'bg-green-100 text-green-700',
                                    'Asignado' => 'bg-blue-100 text-blue-700',
                                    'Perdido' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                                ?>
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase <?php echo $statusColor; ?>">
                                    <?php echo $ticket['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-2 text-gray-400 hover:text-primary transition-colors">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>