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

<body class="vendor-layout">

    <?php \components\ComponentManager::make('sidebar_vendor')->echo(); ?>

    <div class="vendor-wrapper">
        <?php \components\ComponentManager::make('navbar', ['titulo' => $titulo])->echo(); ?>

        <main class="vendor-content">
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
    <script>
        function toggleSidebar() {
            document.querySelector('.vendor-layout').classList.toggle('sidebar-active');
        }
    </script>
</body>

</html>