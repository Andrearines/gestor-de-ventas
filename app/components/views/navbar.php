<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
    <div class="flex items-center gap-4">
        <h2 class="text-lg font-semibold text-gray-800">
            <?php echo $titulo ?? 'Panel de Control'; ?>
        </h2>
    </div>

    <div class="flex items-center gap-4">
        <button class="text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-bell"></i>
        </button>
        <button class="text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-gear"></i>
        </button>
    </div>
</header>