<div class="flex flex-col md:flex-row h-screen bg-gray-50 overflow-hidden font-display">
    
    <!-- Left Side: Product Grid -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Header -->
        <div class="p-6 bg-white border-b border-gray-100 flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">Nueva Venta</h1>
                <p class="text-xs text-gray-500 font-medium mt-1">Selecciona productos para añadir a la orden.</p>
            </div>
            <!-- Search -->
            <div class="relative w-64">
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Buscar combo..." class="w-full pl-9 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
        </div>

        <!-- Categories / Filters (Optional) -->
        <div class="px-6 py-4 flex gap-2 overflow-x-auto shrink-0">
             <button class="px-4 py-2 rounded-xl bg-gray-900 text-white text-xs font-bold shadow-sm whitespace-nowrap transition-transform active:scale-95">Todos</button>
             <button class="px-4 py-2 rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-bold shadow-sm whitespace-nowrap transition-transform active:scale-95">Combos</button>
             <button class="px-4 py-2 rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-bold shadow-sm whitespace-nowrap transition-transform active:scale-95">Bebidas</button>
        </div>

        <!-- Grid -->
        <div class="flex-1 overflow-y-auto p-6 pt-2">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-20">
                <?php foreach ($combos as $combo): ?>
                        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col h-full group hover:shadow-md transition-all cursor-pointer border-transparent hover:border-primary/20" onclick="addToCart(<?php echo $combo['id']; ?>, '<?php echo $combo['nombre']; ?>', <?php echo $combo['precio']; ?>)">
                            <div class="flex-1">
                                 <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-burger text-lg"></i>
                                </div>
                                <h3 class="font-bold text-gray-900 text-sm leading-tight mb-1"><?php echo $combo['nombre']; ?></h3>
                                <p class="text-xs text-gray-400 line-clamp-2">Incluye hamburguesa, papas y refresco.</p>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-lg font-black text-gray-900">$<?php echo number_format($combo['precio'], 2); ?></span>
                                <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-primary hover:text-white flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Right Side: Cart Sidebar -->
    <div class="w-full md:w-96 bg-white border-l border-gray-100 flex flex-col h-full shadow-xl z-20">
        <!-- Customer Info -->
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
             <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-gray-900">Orden Actual</h2>
                <span class="text-xs font-bold px-2 py-1 bg-blue-100 text-blue-700 rounded text-center">#<?php echo rand(1000, 9999); ?></span>
             </div>
             <!-- Ticket Selector -->
             <div class="relative">
                 <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1 block">Asignar a Boleto</label>
                 <select class="w-full bg-white border border-gray-200 text-sm font-bold rounded-xl py-2 px-3 focus:ring-2 focus:ring-primary/20 outline-none">
                     <option value="">Seleccionar boleto...</option>
                     <?php foreach ($boletos as $boleto): ?>
                            <option value="<?php echo $boleto['id']; ?>">#<?php echo $boleto['numero']; ?></option>
                     <?php endforeach; ?>
                 </select>
             </div>
        </div>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto p-4 space-y-3" id="cart-items">
            <!-- Empty State -->
            <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-50">
                <i class="fa-solid fa-basket-shopping text-4xl mb-2"></i>
                <p class="text-sm font-medium">La orden está vacía</p>
            </div>
        </div>

        <!-- Totals & Actions -->
        <div class="p-6 bg-gray-50 mt-auto border-t border-gray-100">
            <div class="space-y-2 mb-6">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Subtotal</span>
                    <span class="font-bold text-gray-900">$0.00</span>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Impuestos (0%)</span>
                    <span class="font-bold text-gray-900">$0.00</span>
                </div>
                 <div class="flex justify-between text-lg font-black text-gray-900 pt-2 border-t border-gray-200 mt-2">
                    <span>Total</span>
                    <span id="cart-total">$0.00</span>
                </div>
            </div>
            
            <button class="w-full py-4 bg-primary hover:bg-primary-dark text-white font-bold rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transform active:scale-95 transition-all">
                <i class="fa-solid fa-check"></i>
                Completar Venta
            </button>
        </div>
    </div>
</div>

<!-- JS Logic Placeholder -->
<script>
    function addToCart(id, name, price) {
        // Logic to add to cart would go here in proper JS file
        console.log("Added", name);
    }
</script>