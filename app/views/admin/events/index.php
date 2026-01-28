<!-- Datos ocultos de PHP para el JS -->
<input type="hidden" id="php-eventos" value='<?php echo json_encode($eventos ?? []); ?>'>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Eventos</h1>
            <p class="text-gray-500">Administra y monitorea los eventos de recaudación activos.</p>
        </div>
        <a href="/admin/events/create"
            class="btn btn-primary flex items-center gap-2 px-6 py-2.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
            <i class="fa-solid fa-calendar-plus"></i>
            Nuevo Evento
        </a>
    </div>

    <!-- Filtros Rápidos -->
    <div class="bg-white p-4 rounded-xl border border-gray-200 flex flex-wrap gap-4 shadow-sm">
        <div class="relative flex-1 min-w-[200px]">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" placeholder="Buscar por nombre o código..."
                class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
        </div>
        <select
            class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-primary">
            <option value="">Todos los estados</option>
            <option value="activo">Activo</option>
            <option value="pendiente">Pendiente</option>
            <option value="finalizado">Finalizado</option>
        </select>
    </div>

    <!-- Tabla de Eventos -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Evento</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (!empty($eventos)):
                        foreach ($eventos as $evento): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                                            <i class="fa-solid fa-calendar-check"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900">
                                            <?php echo $evento['nombre']; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">
                                        <?php echo $evento['codigo']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?php echo $evento['fecha']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                    $statusClass = $evento['status'] === 'Activo' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700';
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo $statusClass; ?>">
                                        <?php echo $evento['status']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="/admin/events/detail?id=<?php echo $evento['id']; ?>"
                                            class="p-2 text-gray-400 hover:text-primary transition-colors" title="Ver Detalles">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <button class="p-2 text-gray-400 hover:text-gray-900 transition-colors" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">No hay eventos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>