<?php
// layouts/sidebar.php : expects $activePage = flood|map|alerts|records
$activePage = $activePage ?? 'flood';
$nav = [
    'flood' => ['Flood Reports', 'flood_reports.php', '<path d="M9 4h6l1 2h3v14H5V6h3zM9 13l2 2 4-4"/>', '1'],
    'map' => ['Hazard Map', 'hazard_map.php', '<path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2zM9 4v14M15 6v14"/>', ''],
    'alerts' => ['Alerts', 'alerts.php', '<path d="M6 8a6 6 0 1 1 12 0c0 7 3 8 3 8H3s3-1 3-8M10 20a2 2 0 0 0 4 0"/>', ''],
    'records' => ['Records', 'records.php', '<path d="M3 7h7l2 2h9v10H3zM3 7V5h7"/>', ''],
];
?>
<aside class="sidebar">
    <div class="side-title">Command navigation</div>
    <nav>
        <?php foreach ($nav as $key => [$label, $href, $icon, $badge]): ?>
            <a href="<?= $href ?>" class="nav-item <?= $key === $activePage ? 'active' : '' ?>">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <?= $icon ?>
                </svg>
                <span>
                    <?= $label ?>
                </span>
                <?php if ($key === 'flood'): ?><span class="badge" id="navBadge">
                        <?= $badge ?>
                    </span>
                <?php endif; ?>
                <?php if ($key === 'alerts'): ?><span class="chip-warn">Push</span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <div class="side-card">
        <div class="side-card-title">Report feed <span class="online"><span class="dot dot-green"></span> Online</span>
        </div>
        <p>Reports come from residents and barangay volunteers. Personnel verify each one before it is published.</p>
    </div>
</aside>