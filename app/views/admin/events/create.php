<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <a href="/admin/events" class="p-2 text-gray-400 hover:text-gray-900 transition-colors">
            <i class="fa-solid fa-arrow-left text-xl"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Crear Nuevo Evento</h1>
            <p class="text-gray-500">Completa el formulario para registrar un nuevo evento de recaudación.</p>
        </div>
    </div>

    <form class="space-y-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nombre del Evento</label>
                        <input type="text" placeholder="Ej. Recaudación Escuela Norte"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Código Único (Automático)</label>
                        <div class="flex gap-2">
                            <input type="text" readonly value="WND-2024-XXXX"
                                class="flex-1 px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl font-mono text-gray-500">
                            <button type="button"
                                class="px-4 py-3 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-primary transition-colors">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Escuela / Institución</label>
                        <select
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all">
                            <option value="">Selecciona una opción</option>
                            <option value="1">Escuela Primaria Norte</option>
                            <option value="2">Instituto Central</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Inicio</label>
                        <input type="date"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Finalización</label>
                        <input type="date"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all">
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Combos y Precios del Evento</h3>
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Combo</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Precio Base</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Precio Evento</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="px-6 py-4 font-medium">Dave's Single Combo</td>
                                    <td class="px-6 py-4 text-gray-500">$8.50</td>
                                    <td class="px-6 py-4">
                                        <div class="relative max-w-[120px]">
                                            <span
                                                class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                                            <input type="number" step="0.01" value="8.50"
                                                class="w-full pl-7 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-4">
                <button type="button"
                    class="px-6 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-gray-200 transition-all">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-10 py-2.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all">
                    Crear Evento
                </button>
            </div>
        </div>
    </form>
</div>