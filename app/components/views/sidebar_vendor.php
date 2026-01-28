<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <div class="p-6 border-b text-center">
        <i class="fa-solid fa-burger text-primary text-3xl mb-2"></i>
        <h1 class="text-lg font-bold">Wendy's Vendedor</h1>
    </div>
    <nav class="flex-1 py-4 px-4 space-y-2">
        <a href="/vendor/dashboard"
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-600 transition-colors">
            <i class="fa-solid fa-house w-6"></i>
            <span class="font-medium">Inicio</span>
        </a>
        <a href="/vendor/sales"
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-600 transition-colors">
            <i class="fa-solid fa-cash-register w-6"></i>
            <span class="font-medium">Ventas</span>
        </a>
    </nav>
    <div class="p-4 border-t">
        <a href="/auth/logout" class="flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 rounded-lg">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Salir</span>
        </a>
    </div>
</aside>