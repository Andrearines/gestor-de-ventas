<aside class="sidebar sidebar-vendor">
    <div class="sidebar-header">
        <div class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div class="brand-text">
                <h1>Wendy's Vendor</h1>
                <p>Portal de Ventas</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="/vendor/dashboard"
            class="nav-link <?php echo ($currentPage ?? '') === 'dashboard' ? 'active' : ''; ?>">
            <i class="fa-solid fa-chart-simple"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="/vendor/sales" class="nav-link <?php echo ($currentPage ?? '') === 'sales' ? 'active' : ''; ?>">
            <i class="fa-solid fa-money-bill-wave"></i>
            <span class="font-medium">Ventas</span>
        </a>
        <a href="/vendor/reservations"
            class="nav-link <?php echo ($currentPage ?? '') === 'reservations' ? 'active' : ''; ?>">
            <i class="fa-solid fa-clock"></i>
            <span class="font-medium">Reservas</span>
        </a>
        <a href="/vendor/tickets" class="nav-link <?php echo ($currentPage ?? '') === 'tickets' ? 'active' : ''; ?>">
            <i class="fa-solid fa-ticket"></i>
            <span class="font-medium">Mis Boletos</span>
        </a>

        <div class="nav-divider">
            <span class="nav-section-title">Estadísticas</span>
        </div>

        <a href="/vendor/stats" class="nav-link <?php echo ($currentPage ?? '') === 'stats' ? 'active' : ''; ?>">
            <i class="fa-solid fa-chart-bar"></i>
            <span class="font-medium">Mis Estadísticas</span>
        </a>

    </nav>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-info">
                <p>
                    <?php echo $_SESSION['user_name'] ?? 'Vendedor'; ?>
                </p>
                <a href="/auth/logout" class="logout-link">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</aside>