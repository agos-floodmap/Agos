<?php
$basePath = "../../";
require_once __DIR__ . "/../../controllers/controller.php";
$user = requireLogin($basePath);
require_once __DIR__ . "/../../models/ReportData.php";

$bodyClass = "app-page";
$showTopbar = true;
$withApp = true;
$opsLabel = "CDRRMO Operations Center";
$pageScript = "assets/cdrrmo.js";
$pageTitle = "City Flood Records";
$activePage = "records";
$pendingCount = 3;

$rows = cityRecords();
$places = array_values(array_unique(array_column($rows, "place")));

require __DIR__ . "/../../layouts/header.php";
?>
<div class="app-shell">
    <?php require __DIR__ . "/../../layouts/sidebar.php"; ?>
    <div class="main-content">
        <?php require __DIR__ . "/../../layouts/topbar.php"; ?>
        <main class="content">
            <section class="page-head">
                <div>
                    <div class="crumb">CDRRMO / <span class="link-blue">Records</span></div>
                    <h1>City Flood Records</h1>
                </div>
            </section>

            <section class="card panel">
                <div class="filters-row">
                    <div class="field">
                        <label for="rBrgy">Barangay</label>
                        <select id="rBrgy" class="select">
                            <option value="">All barangays</option>
                            <?php foreach ($places as $p): ?>
                                <option><?= $p ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="rFrom">From</label>
                        <input type="date" id="rFrom" class="input" value="2026-10-01">
                    </div>
                    <div class="field">
                        <label for="rTo">To</label>
                        <input type="date" id="rTo" class="input" value="2026-11-19">
                    </div>
                    <div class="field">
                        <label for="rStatus">Report status</label>
                        <select id="rStatus" class="select">
                            <option value="">All</option>
                            <option>Verified</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" id="rSearch">Search</button>
                </div>

                <div class="table-wrap">
                    <table class="table" id="rTable">
                        <thead>
                            <tr>
                                <th>Date and time</th>
                                <th>Location</th>
                                <th>Water</th>
                                <th>Road</th>
                                <th>Report</th>
                                <th>Alert</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r): ?>
                                <tr data-place="<?= $r["place"] ?>"
                                    data-date="<?= $r["date"] ?>"
                                    data-report="<?= $r["report"] ?>">
                                    <td><?= $r["label"] ?></td>
                                    <td><strong><?= $r["place"] ?></strong></td>
                                    <td class="mono"><?= $r["water"] ?></td>
                                    <td><?= $r["road"] ?></td>
                                    <td><span class="status-tag st-<?= strtolower($r["report"]) ?>"><?= $r["report"] ?></span></td>
                                    <td><?= $r["alert"] ?></td>
                                    <td><button class="link-btn" data-view>View</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <p class="empty" id="rEmpty" hidden>No records match. Widen the date range or choose another barangay.</p>
            </section>

            <p class="foot-note">One central repository for flood reports, verification records, road conditions, and alerts.</p>
        </main>
    </div>
</div>
<?php require __DIR__ . "/../../layouts/footer.php"; ?>
