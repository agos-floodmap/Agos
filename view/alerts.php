<?php
require_once __DIR__ . '/../controllers/guard.php';
$pageTitle = 'Alerts';
$bodyClass = 'app-page';
$basePath = '../';
$showTopbar = true;
$withApp = true;
$activePage = 'alerts';
require __DIR__ . '/../layouts/header.php';
?>
<div class="app-shell">
    <?php require __DIR__ . '/../layouts/sidebar.php'; ?>
    <main class="content">
        <section class="card page-head">
            <div>
                <div class="crumb">Barangay Operations / <span class="link-blue">Alerts</span></div>
                <h1>Send a community alert</h1>
            </div>
        </section>

        <section class="alerts-grid">
            <div class="card panel pad">
                <h2>New alert</h2>
                <form id="alertForm" class="login-form" novalidate>
                    <div class="field">
                        <label for="zone">Priority area</label>
                        <select id="zone" class="select">
                            <option>All barangays</option>
                            <option>Lopez Jaena (Zone 3)</option>
                            <option>Sabang (Zone 1)</option>
                            <option>Santa Barbara (Zone 2)</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="msg">Message</label>
                        <textarea id="msg" class="textarea" rows="5"
                            placeholder="Location, water level and road passability"></textarea>
                    </div>
                    <div class="row-between">
                        <button type="button" class="btn btn-ghost" data-action="use-template">Use verified report
                            details</button>
                        <button type="submit" class="btn btn-primary">Send alert</button>
                    </div>
                </form>
            </div>
            <div class="card panel pad">
                <h2>Sent alerts</h2>
                <ul class="feed" id="sentList">
                    <li><strong>Sabang:</strong> 0.3 m, light vehicles with caution. <span class="muted small">2:15
                            PM</span></li>
                    <li><strong>Santa Barbara:</strong> 0.1 m, passable. <span class="muted small">1:30 PM</span></li>
                </ul>
            </div>
        </section>
    </main>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>