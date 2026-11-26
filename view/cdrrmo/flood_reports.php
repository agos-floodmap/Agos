<?php require __DIR__ . "/../../layouts/header.php"; ?>
<div class="app-shell">
    <?php require __DIR__ . "/../../layouts/sidebar.php"; ?>
    <div class="main-content">
        <?php require __DIR__ . "/../../layouts/topbar.php"; ?>
        <main class="content">
            <section class="page-head">
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
                            <article class="rcard"
                                     data-status="<?= $r["status"] ?>"
                                     data-title="<?= htmlspecialchars($r["title"]) ?>"
                                     data-level="<?= $r["level"] ?>"
                                     data-road="<?= $r["road"] ?>"
                                     data-source="<?= $r["source"] ?>"
                                     data-time="<?= $r["time"] ?>"
                                     data-media="<?= $r["media"] ?>">
                                <div>
                                    <h3><?= htmlspecialchars($r["title"]) ?></h3>
                                    <p><strong class="mono"><?= $r["level"] ?></strong> | <?= $r["road"] ?></p>
                                    <p class="rcard-sub"><?= $r["source"] ?> | <?= $r["time"] ?> | <?= $r["media"] ?></p>
                                </div>
                                <div class="rcard-action">
                                    <button class="btn btn-primary" data-review>Review</button>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <p class="empty card" id="reportEmpty" hidden></p>
                    <p class="foot-note">Reports from all barangays arrive in one city-wide list.</p>
                </div>

                <aside class="card city-map">
                    <h2>City map</h2>
                    <svg viewBox="0 0 300 340" role="img" aria-label="City map"></svg>
                </aside>
            </section>
        </main>
    </div>
</div>
<?php require __DIR__ . "/../../layouts/footer.php"; ?>
