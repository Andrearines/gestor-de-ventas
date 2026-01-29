<header class="navbar">
    <div class="navbar-mobile-toggle" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="navbar-left">
        <div class="breadcrumb">
            <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
                <?php foreach ($breadcrumbs as $index => $crumb): ?>
                    <?php if ($index > 0): ?>
                        <span class="breadcrumb-separator">/</span>
                    <?php endif; ?>
                    <?php if (isset($crumb['url']) && $index < count($breadcrumbs) - 1): ?>
                        <a href="<?php echo $crumb['url']; ?>" class="breadcrumb-link">
                            <?php echo $crumb['label']; ?>
                        </a>
                    <?php else: ?>
                        <span class="breadcrumb-current"><?php echo $crumb['label'] ?? $crumb; ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="navbar-title">
            <h2><?php echo $titulo ?? 'Panel de Control'; ?></h2>
        </div>
    </div>

    <div class="navbar-tools">

        <div class="user-avatar">
            <div class="avatar-circle">
                <?php
                $initials = 'AD';
                if (isset($_SESSION['user_name'])) {
                    $names = explode(' ', $_SESSION['user_name']);
                    $initials = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                }
                echo $initials;
                ?>
            </div>
        </div>
    </div>
</header>