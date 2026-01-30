<aside class="sidebar">
    <div class="sidebar-header">
        <div class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div class="brand-text">
                <h1>Wendy's Admin</h1>
                <p>Sistema de Ventas</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="/admin/dashboard" class="nav-link <?php echo ($currentPage ?? '') === 'dashboard' ? 'active' : ''; ?>">
            <i class="fa-solid fa-chart-line"></i>
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="/admin/events" class="nav-link <?php echo ($currentPage ?? '') === 'events' ? 'active' : ''; ?>">
            <i class="fa-solid fa-calendar-days"></i>
            <span class="font-medium">Eventos</span>
        </a>
        <a href="/admin/tickets" class="nav-link <?php echo ($currentPage ?? '') === 'tickets' ? 'active' : ''; ?>">
            <i class="fa-solid fa-ticket"></i>
            <span class="font-medium">Boletos</span>
        </a>
        <a href="/admin/combos" class="nav-link <?php echo ($currentPage ?? '') === 'combos' ? 'active' : ''; ?>">
            <i class="fa-solid fa-burger"></i>
            <span class="font-medium">Combos</span>
        </a>
        <a href="/admin/teams" class="nav-link <?php echo ($currentPage ?? '') === 'teams' ? 'active' : ''; ?>">
            <i class="fa-solid fa-users"></i>
            <span class="font-medium">Equipos</span>
        </a>
        <a href="/admin/sales" class="nav-link <?php echo ($currentPage ?? '') === 'sales' ? 'active' : ''; ?>">
            <i class="fa-solid fa-money-bill-trend-up"></i>
            <span class="font-medium">Ventas</span>
        </a>
        <a href="/admin/reservations"
            class="nav-link <?php echo ($currentPage ?? '') === 'reservations' ? 'active' : ''; ?>">
            <i class="fa-solid fa-clock"></i>
            <span class="font-medium">Reservas</span>
        </a>

    </nav>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-info">
                <p>
                    <?php echo $_SESSION['user_name'] ?? 'Administrador'; ?>
                </p>
                <a href="/auth/logout" class="logout-link">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</aside>