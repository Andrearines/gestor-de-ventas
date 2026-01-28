<aside class="sidebar w-64 bg-white border-r border-gray-200 flex flex-col">
    <div class="p-6 border-b">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-burger text-primary text-2xl"></i>
            <h1 class="text-xl font-bold">Wendy's Benéfico</h1>
        </div>
    </div>

    <nav class="flex-1 py-4 px-4 space-y-2">
        <a href="/admin/dashboard"
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-600 transition-colors">
            <i class="fa-solid fa-chart-line w-6"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="/admin/events"
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-600 transition-colors">
            <i class="fa-solid fa-calendar-days w-6"></i>
            <span class="font-medium">Eventos</span>
        </a>
        <a href="/admin/tickets"
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-gray-600 transition-colors">
            <i class="fa-solid fa-ticket w-6"></i>
            <span class="font-medium">Boletos</span>
        </a>
        <!-- Otros links... -->
    </nav>

    <div class="p-4 border-t">
        <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold truncate">Administrador</p>
                <a href="/auth/logout" class="text-xs text-red-500 hover:text-red-700">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</aside>