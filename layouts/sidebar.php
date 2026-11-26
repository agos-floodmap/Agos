<?php

$activePage = $activePage ?? 'flood';
$basePath = $basePath ?? '';
$nav = [
    'flood' => ['Flood Reports', 'flood_reports.php', '<path d="M9 4h6l1 2h3v14H5V6h3zM9 13l2 2 4-4"/>', '1'],
    'map' => ['Hazard Map', 'hazard_map.php', '<path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2zM9 4v14M15 6v14"/>', ''],
    'alerts' => ['Alerts', 'alerts.php', '<path d="M6 8a6 6 0 1 1 12 0c0 7 3 8 3 8H3s3-1 3-8M10 20a2 2 0 0 0 4 0"/>', ''],
    'records' => ['Records', 'records.php', '<path d="M3 7h7l2 2h9v10H3zM3 7V5h7"/>', ''],
];
?>
<aside class="sidebar">
    <a href="flood_reports.php" class="logo">
        <span class="logo-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M3 8c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1" />
                <path d="M3 13c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1" />
                <path d="M3 18c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1" />
            </svg>
        </span>
        AGOS
    </a>
    <nav class="nav-menu">
        <?php foreach ($nav as $key => [$label, $href, $icon, $badge]): ?>
            <a href="<?= $href ?>" class="nav-item <?= $key === $activePage ? 'active' : '' ?>">
                <svg viewBox="0 0 24 24"><?= $icon ?></svg>
                <span><?= $label ?></span>
                <?php if ($key === 'flood' && ($pendingCount ?? 1) > 0): ?><span class="badge"
                        id="navBadge"><?= (int) ($pendingCount ?? 1) ?></span><?php endif; ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <div class="sidebar-bottom">
        <div class="sidebar-signout">
            <a class="nav-item" href="<?= $basePath ?>controllers/controller.php?action=logout">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                <span>Sign out</span>
            </a>
        </div>
    </div>
</aside>