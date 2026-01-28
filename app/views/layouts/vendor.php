<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $titulo; ?> | Vendedor - Gestor de Ventas
    </title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Estilos compilados -->
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body class="vendor-layout flex h-screen overflow-hidden">
    
    <?php \components\ComponentManager::make('sidebar_vendor')->echo(); ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white border-b border-gray-200 flex items-center px-8 shrink-0">
            <h2 class="text-lg font-semibold"><?php echo $titulo; ?></h2>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            <?php echo $contenedor; ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if (isset($script)) {
        foreach ($script as $s) {
            echo "<script src='/build/js/{$s}.js'></script>";
        }
    }
    ?>
</body>

</html>