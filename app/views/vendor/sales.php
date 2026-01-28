<!-- Datos ocultos de PHP para el JS -->
<input type="hidden" id="php-combos" value='<?php echo json_encode($combos ?? []); ?>'>
<input type="hidden" id="php-boletos" value='<?php echo json_encode($boletos ?? []); ?>'>

<div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Columna Izquierda: Formulario de Venta -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-cart-plus text-primary"></i>
                Nueva Transacción
            </h3>

            <form id="form-venta" class="space-y-6">
                <!-- Selección de Boleto -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Selecciona un Boleto Físico</label>
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
                        <?php foreach ($boletos as $b): ?>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="boleto_id" value="<?php echo $b['id']; ?>" class="peer sr-only">
                                <div
                                    class="p-3 text-center border-2 border-gray-100 rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all group-hover:border-gray-200">
                                    <span class="block text-xs font-bold text-gray-400 peer-checked:text-primary">#</span>
                                    <span class="text-sm font-black text-gray-700 peer-checked:text-primary">
                                        <?php echo $b['numero']; ?>
                                    </span>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Selección de Combos -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">Añadir Combo (Opcional)</label>
                    <div class="space-y-3">
                        <?php foreach ($combos as $c): ?>
                            <div
                                class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-burger text-orange-400"></i>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">
                                            <?php echo $c['nombre']; ?>
                                        </p>
                                        <p class="text-xs text-gray-500">$
                                            <?php echo number_format($c['precio'], 2); ?>
                                        </p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center hover:bg-primary transition-colors hover:text-white">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Columna Derecha: Resumen y Confirmación -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm sticky top-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-4 border-b">Resumen de Venta</h3>

            <div class="space-y-4 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Boleto Seleccionado:</span>
                    <span class="font-bold text-gray-900" id="resumen-boleto">Ninguno</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Combo:</span>
                    <span class="font-bold text-gray-900" id="resumen-combo">Sin combo</span>
                </div>
            </div>

            <div class="pt-4 border-t border-dashed border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-lg font-bold text-gray-900">Total:</span>
                    <span class="text-2xl font-black text-primary" id="resumen-total">$0.00</span>
                </div>

                <button type="button"
                    class="w-full py-4 bg-primary text-white font-black rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all transform active:scale-95 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check-double"></i>
                    Confirmar Venta
                </button>
            </div>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-100 rounded-xl">
            <div class="flex gap-3">
                <i class="fa-solid fa-circle-exclamation text-yellow-600 mt-0.5"></i>
                <p class="text-xs text-yellow-800 font-medium leading-relaxed">
                    Asegúrate de que el boleto físico coincida con el número seleccionado antes de confirmar.
                </p>
            </div>
        </div>
    </div>
</div>