<?php
require_once __DIR__ . '/../controllers/guard.php';
require_once __DIR__ . '/../models/ReportData.php';
$r = sampleReports()[0];

$pageTitle = 'Flood Reports';
$bodyClass = 'app-page';
$basePath = '../';
$showTopbar = true;
$withApp = true;
$activePage = 'flood';
require __DIR__ . '/../layouts/header.php';
?>
<div class="app-shell">
    <?php require __DIR__ . '/../layouts/sidebar.php'; ?>
    <main class="content">

        <section class="card page-head">
            <div>
                <div class="crumb">Barangay Operations / <span class="link-blue">Active Report Verification</span></div>
                <h1>Incident Inspection &amp; Field Validation <span class="pill pill-red-soft">High priority</span>
                </h1>
            </div>
            <div class="head-right">
                <span class="sync">Sync status: <strong>Cloud active</strong></span>
                <button class="btn btn-primary" data-action="refresh">Refresh feed</button>
            </div>
        </section>

        <section class="card panel">
            <div class="panel-head">
                <h2><span class="dot dot-blue"></span> Report details and incident matching</h2>
                <span class="mono-chip">Incident ID:
                    <?= $r['id'] ?>
                </span>
            </div>

            <div class="panel-grid">
                <!-- Left: depth model + resident report -->
                <div class="stack">
                    <div class="inner-card">
                        <div class="inner-head">
                            <strong>Road depth model</strong>
                            <span class="mono-chip tint">Lopez Jaena Marker #4</span>
                        </div>
                        <div class="depth">
                            <span class="d-mark d-crit">1.5m (critical threshold)</span>
                            <span class="d-mark d-warn">1.0m</span>
                            <div class="d-pole"><span>1.5m</span></div>
                            <div class="d-water"><span class="d-label">Reported level: 0.5m</span></div>
                            <div class="d-road">Road bed elevation cross section</div>
                        </div>
                    </div>

                    <div class="inner-card">
                        <div class="inner-head">
                            <strong class="link-blue">Matching resident report</strong>
                            <span class="muted small">3:45 PM</span>
                        </div>
                        <dl class="kv">
                            <dt>Reporter:</dt>
                            <dd>Verified Citizen #4902</dd>
                            <dt>Observed water:</dt>
                            <dd class="link-blue">0.5m (knee deep)</dd>
                        </dl>
                        <div class="inner-head" style="margin-top:8px">
                            <span class="success small">Video attached</span>
                            <a href="#" class="link small" data-action="video">View video clip</a>
                        </div>
                    </div>
                </div>

                <!-- Right: details + decision -->
                <div class="stack">
                    <div class="inner-card detail-grid">
                        <div>
                            <div class="meta-label">Location</div>
                            <div class="big">
                                <?= $r['location'] ?>
                            </div>
                            <div class="muted small">
                                <?= $r['zone'] ?>
                            </div>
                        </div>
                        <div>
                            <div class="meta-label">Severity</div>
                            <span class="pill pill-red-soft" id="severityPill"><span class="dot dot-red"></span>
                                <?= strtoupper($r['severity']) ?>
                            </span>
                        </div>
                        <div>
                            <div class="meta-label">Water level (reported)</div>
                            <div class="level mono">
                                <?= $r['level'] ?>
                            </div>
                            <div class="warn small">Exceeds light vehicle limit</div>
                        </div>
                        <div>
                            <div class="meta-label">Road status</div>
                            <span class="pill pill-red-soft">
                                <?= strtoupper($r['road']) ?>
                            </span>
                        </div>
                        <div>
                            <div class="meta-label">Time logged</div>
                            <div><strong class="mono">
                                    <?= $r['time'] ?>
                                </strong> <span class="muted small">(6 mins ago)</span></div>
                        </div>
                        <div>
                            <div class="meta-label">Sent by</div>
                            <div><strong>
                                    <?= $r['by'] ?>
                                </strong></div>
                            <div class="muted small">Designated Barangay Volunteer</div>
                        </div>
                    </div>

                    <div class="inner-card decision" id="decisionBox">
                        <div class="decision-text">
                            <strong>Decision required:</strong>
                            Verifying publishes this report to the hazard map and sends the community alert.
                        </div>
                        <div class="decision-btns">
                            <button class="btn btn-outline-red" data-action="reject">Reject</button>
                            <button class="btn btn-green" data-action="verify">Verify report</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>