<?php if ($showTopbar): ?>
<header class="topbar">
    <div class="topbar-date" id="topbarDate"></div>
    <div class="topbar-right">
        <div class="menu-wrap">
            <button class="icon-btn" data-action="bell" aria-label="Notifications">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 8 3 8H3s3-1 3-8M10 20a2 2 0 0 0 4 0"/></svg>
                <span class="notif-dot" id="notifDot"></span>
            </button>
            <div class="dropdown" id="bellMenu" hidden>
                <div class="dropdown-title">Notifications</div>
                <a href="<?= $basePath ?>controllers/cdrrmo/cdrrmo_controller.php?page=flood_reports">New report from Lopez Jaena, awaiting review</a>
                <a href="<?= $basePath ?>controllers/cdrrmo/cdrrmo_controller.php?page=records">Pinagbarilan report was rejected earlier today</a>
            </div>
        </div>
        <div class="menu-wrap">
            <button type="button" class="user-chip" data-action="user-menu" aria-expanded="false" aria-controls="userMenu">
                <span class="user-name"><?= htmlspecialchars(!empty($opsLabel) ? $opsLabel : ($user['name'] ?? 'User')) ?></span>
                <div class="avatar"><?= htmlspecialchars($user['initials'] ?? 'BP') ?></div>
                <svg class="user-caret" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="dropdown user-dropdown" id="userMenu" hidden>
                <div class="user-dropdown-head">
                    <div class="user-dropdown-name"><?= htmlspecialchars($user['name'] ?? 'User') ?></div>
                    <div class="user-dropdown-meta"><?= htmlspecialchars(implode(' · ', array_filter([$user['username'] ?? '', $user['role'] ?? '']))) ?></div>
                </div>
                <div class="dropdown-sep"></div>
                <a class="dropdown-danger" href="<?= $basePath ?>controllers/auth_controller.php?action=logout">Sign out</a>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>
