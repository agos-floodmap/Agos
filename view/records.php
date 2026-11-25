<?php
require_once __DIR__ . '/../controllers/guard.php';
require_once __DIR__ . '/../models/ReportData.php';
$pageTitle = 'Records';
$bodyClass = 'app-page';
$basePath = '../';
$showTopbar = true;
$withApp = true;
$activePage = 'records';
require __DIR__ . '/../layouts/header.php';
?>
<div class="app-shell">
    <?php require __DIR__ . '/../layouts/sidebar.php'; ?>
    <main class="content">
        <section class="card page-head">
            <div>
                <div class="crumb">Barangay Operations / <span class="link-blue">Records</span></div>
                <h1>Flood report records</h1>
            </div>
            <div class="head-right">
                <input type="search" id="recSearch" class="input-sm" placeholder="Search location or ID"
                    aria-label="Search records">
                <select id="recStatus" class="select sm" aria-label="Filter by status">
                    <option value="">All statuses</option>
                    <option>Pending</option>
                    <option>Verified</option>
                    <option>Rejected</option>
                </select>
                <button class="btn btn-ghost" data-action="export">Export</button>
            </div>
        </section>

        <section class="card panel">
            <div class="table-wrap">
                <table class="table" id="recTable">
                    <thead>
                        <tr>
                            <th>Incident ID</th>
                            <th>Location</th>
                            <th>Level</th>
                            <th>Severity</th>
                            <th>Road status</th>
                            <th>Time</th>
                            <th>Sent by</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (sampleReports() as $r): ?>
                            <tr>
                                <td class="mono">
                                    <?= $r['id'] ?>
                                </td>
                                <td><strong>
                                        <?= $r['location'] ?>
                                    </strong>
                                    <div class="muted small">
                                        <?= $r['zone'] ?>
                                    </div>
                                </td>
                                <td class="mono">
                                    <?= $r['level'] ?>
                                </td>
                                <td>
                                    <?= $r['severity'] ?>
                                </td>
                                <td>
                                    <?= $r['road'] ?>
                                </td>
                                <td>
                                    <?= $r['time'] ?>
                                </td>
                                <td>
                                    <?= $r['by'] ?>
                                </td>
                                <td><span class="status-tag st-<?= strtolower($r['status']) ?>">
                                        <?= $r['status'] ?>
                                    </span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p class="empty" id="recEmpty" hidden>No records match. Clear the search or choose another status.</p>
        </section>
    </main>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>