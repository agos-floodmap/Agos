<?php
$basePath = "../../";
require_once __DIR__ . "/../../controllers/controller.php";
$user = requireLogin($basePath);
require_once __DIR__ . "/../../models/ReportData.php";
$bodyClass = "app-page"; $showTopbar = true; $withApp = true;
$opsLabel = "CDRRMO Operations Center"; $pageScript = "assets/cdrrmo.js";
$pageTitle = "City Flood Reports"; $activePage = "flood";
$reports = cdrrmoReports();
$pendingCount = count(array_filter($reports, fn($r) => $r["status"] === "pending"));
require __DIR__ . "/../../layouts/header.php";
?>
<div class="app-shell">
<?php require __DIR__ . "/../../layouts/sidebar.php"; ?>
<main class="content">
    <section class="card page-head">
        <div>
            <div class="crumb">CDRRMO / <span class="link-blue">Flood reports</span></div>
            <h1>City Flood Reports</h1>
        </div>
        <div class="seg" role="group" aria-label="Filter reports">
            <button class="seg-btn active" data-rfilter="all">All barangays</button>
            <button class="seg-btn" data-rfilter="pending" id="pendingTab">Pending (<?= $pendingCount ?>)</button>
            <button class="seg-btn" data-rfilter="verified">Verified</button>
        </div>
    </section>

    <section class="cdrrmo-grid">
        <div>
            <div class="rlist" id="reportList">
            <?php foreach ($reports as $r): ?>
                <article class="rcard" data-status="<?= $r["status"] ?>" data-title="<?= htmlspecialchars($r["title"]) ?>"
                         data-level="<?= $r["level"] ?>" data-road="<?= $r["road"] ?>" data-source="<?= $r["source"] ?>"
                         data-time="<?= $r["time"] ?>" data-media="<?= $r["media"] ?>">
                    <div>
                        <h3><?= htmlspecialchars($r["title"]) ?></h3>
                        <p><strong class="mono"><?= $r["level"] ?></strong> | <?= $r["road"] ?></p>
                        <p class="rcard-sub"><?= $r["source"] ?> | <?= $r["time"] ?> | <?= $r["media"] ?></p>
                    </div>
                    <div class="rcard-action"><button class="btn btn-primary" data-review>Review</button></div>
                </article>
            <?php endforeach; ?>
            </div>
            <p class="empty card" id="reportEmpty" hidden></p>
            <p class="foot-note">Reports from all barangays arrive in one city-wide list.</p>
        </div>

        <aside class="card city-map">
            <h2>City map</h2>
            <svg viewBox="0 0 300 340" role="img" aria-label="Illustration of reported flood locations">
                <path d="M-5 300 C 60 290, 110 250, 170 258 S 260 230, 305 190" class="river"/>
                <path d="M10 70 C 80 120, 160 140, 295 165" class="hwy"/>
                <text x="20" y="62" class="lbl">DRT Highway</text>
                <circle cx="95" cy="205" r="10" class="pin-h"/><text x="60" y="232" class="lbl">Concepcion</text>
                <circle cx="150" cy="128" r="10" class="pin-h"/><text x="120" y="108" class="lbl">Ultramega</text>
                <circle cx="215" cy="238" r="10" class="pin-l"/><text x="190" y="270" class="lbl">Tibag</text>
                <text x="205" y="310" class="lbl river-lbl">Angat River</text>
            </svg>
            <p class="map-note">Illustration only, not to scale.</p>
        </aside>
    </section>
</main>
</div>
<?php require __DIR__ . "/../../layouts/footer.php"; ?>
