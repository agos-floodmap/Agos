<?php
require_once __DIR__ . '/../controllers/guard.php';
$pageTitle = 'Hazard Map';
$bodyClass = 'app-page';
$basePath = '../';
$showTopbar = true;
$withApp = true;
$activePage = 'map';
$pins = [
    ['Lopez Jaena', 'High', '0.5 m', 'Not passable', 62, 30, 'high'],
    ['Sabang', 'Moderate', '0.3 m', 'Light vehicles with caution', 30, 55, 'mod'],
    ['Santa Barbara', 'Low', '0.1 m', 'Passable', 74, 68, 'low'],
];
require __DIR__ . '/../layouts/header.php';
?>
<div class="app-shell">
        <?php require __DIR__ . '/../layouts/sidebar.php'; ?>
    <main class="content">
        <section class="card page-head">
            <div>
                <div class="crumb">Barangay Operations / <span class="link-blue">Hazard Map</span></div>
                <h1>Verified flood reports in Baliwag City</h1>
            </div>
            <div class="head-right">
                <div class="seg" role="group" aria-label="Filter by severity">
                    <button class="seg-btn active" data-filter-pin="all">All</button>
                    <button class="seg-btn" data-filter-pin="high">High</button>
                    <button class="seg-btn" data-filter-pin="mod">Moderate</button>
                    <button class="seg-btn" data-filter-pin="low">Low</button>
                </div>
            </div>
        </section>

        <section class="map-grid">
            <div class="card map-box">
                <svg class="map-svg" viewBox="0 0 100 80" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M0 18 C 25 30, 40 8, 60 22 S 90 40, 100 30 L100 40 C 90 50, 65 34, 58 32 S 20 44, 0 28Z"
                        class="map-river" />
                    <path d="M10 70 L40 50 L70 60 L95 40" class="map-road" />
                    <path d="M50 0 L55 80" class="map-road" />
                    <path d="M0 55 L100 62" class="map-road" />
                </svg>
                <span class="map-label" style="left:6%;top:12%">Angat River</span>
                    <?php foreach ($pins as $i => [$n, $s, $l, $rd, $x, $y, $c]): ?>
                    <button class="pin pin-<?= $c ?>" data-pin="<?= $c ?>" style="left:<?= $x ?>%;top:<?= $y ?>%"
                        data-name="<?= $n ?>" data-sev="<?= $s ?>" data-level="<?= $l ?>" data-road="<?= $rd ?>"
                        aria-label="<?= $n ?>, <?= $s ?> severity"></button>
                    <?php endforeach; ?>
            </div>
            <div class="card map-detail" id="pinDetail">
                <h2>Select a marker</h2>
                <p class="muted">Click a marker on the map to see its water level and road status.</p>
            </div>
        </section>
    </main>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>