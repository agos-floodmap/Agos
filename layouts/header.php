<?php

$pageTitle = $pageTitle ?? 'AGOS';
$bodyClass = $bodyClass ?? '';
$basePath = $basePath ?? '';
$showTopbar = $showTopbar ?? false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= htmlspecialchars($pageTitle) ?> | AGOS
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>assets/styles.css">
</head>

<body class="<?= htmlspecialchars($bodyClass) ?>">
    <?php if ($showTopbar): ?>
        <header class="topbar">
            <div class="brand-row">
                <div class="brand-logo sm" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="2"
                        stroke-linecap="round">
                        <path d="M3 8c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1" />
                        <path d="M3 13c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1" />
                        <path d="M3 18c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1" />
                    </svg>
                </div>
                <div>
                    <div class="brand-name">AGOS <span class="tag">AR Mapping DRRM</span></div>
                    <div class="brand-sub">Barangay Flood Monitoring &amp; Alert Broadcast</div>
                </div>
            </div>

            <div class="live-pill">
                <span class="dot dot-red"></span> Report feed active:
                <strong id="pendingCount">1 report in review</strong>
                <span class="sep"></span>
                <span class="mono" id="clock">
                    <?= date('M d, Y, h:i:s A') ?> PHT
                </span>
            </div>

            <div class="topbar-right">
                <div class="user-chip">
                    <div class="avatar">
                        <?= htmlspecialchars($user['initials'] ?? 'BP') ?><span class="dot dot-green"></span>
                    </div>
                    <div>
                        <div class="user-name">
                            <?= htmlspecialchars($user['name'] ?? 'User') ?>
                        </div>
                        <div class="user-role">
                            <?= htmlspecialchars($user['role'] ?? '') ?>
                        </div>
                    </div>
                </div>
                <div class="menu-wrap">
                    <button class="icon-btn" data-action="bell" aria-label="Notifications">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 8a6 6 0 1 1 12 0c0 7 3 8 3 8H3s3-1 3-8M10 20a2 2 0 0 0 4 0" />
                        </svg>
                        <span class="notif-dot" id="notifDot"></span>
                    </button>
                    <div class="dropdown" id="bellMenu" hidden>
                        <div class="dropdown-title">Notifications</div>
                        <a href="flood_reports.php">New report from Lopez Jaena, awaiting review</a>
                        <a href="records.php">Pinagbarilan report was rejected earlier today</a>
                    </div>
                </div>
                <a class="btn btn-ghost" href="../controllers/logout.php">Sign out</a>
            </div>
        </header>
    <?php endif; ?>