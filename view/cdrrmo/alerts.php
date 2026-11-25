<?php
$basePath = "../../";
require_once __DIR__ . "/../../controllers/controller.php";
$user = requireLogin($basePath);
require_once __DIR__ . "/../../models/ReportData.php";
$bodyClass = "app-page"; $showTopbar = true; $withApp = true;
$opsLabel = "CDRRMO Operations Center"; $pageScript = "assets/cdrrmo.js";
$pageTitle = "Publish City Alert"; $activePage = "alerts"; $pendingCount = 3;
require __DIR__ . "/../../layouts/header.php";
?>
<div class="app-shell">
<?php require __DIR__ . "/../../layouts/sidebar.php"; ?>
<main class="content">
    <section class="card page-head">
        <div>
            <div class="crumb">CDRRMO / <span class="link-blue">Alerts</span></div>
            <h1>Publish City Alert</h1>
        </div>
    </section>

    <section class="alerts-two">
        <form class="card panel pad" id="cityAlertForm" novalidate>
            <div class="field">
                <label for="alLoc">Location</label>
                <input type="text" id="alLoc" class="input" value="DRT Highway, Ultramega area">
            </div>
            <div class="form-grid">
                <div class="field">
                    <label for="alDepth">Depth</label>
                    <input type="text" id="alDepth" class="input" value="0.5 m">
                </div>
                <div class="field">
                    <label for="alRoad">Road</label>
                    <select id="alRoad" class="select">
                        <option>Not passable to light vehicles</option>
                        <option>Not passable</option>
                        <option>Passable</option>
                    </select>
                </div>
            </div>

            <fieldset class="checks"><legend>Send to</legend>
                <label class="check"><input type="checkbox" name="grp" checked> <span>Affected areas first</span></label>
                <label class="check"><input type="checkbox" name="grp" checked> <span>Residents of Baliwag City</span></label>
                <label class="check"><input type="checkbox" name="grp" checked> <span>Commuters and drivers passing through</span></label>
            </fieldset>

            <label class="notice check"><input type="checkbox" id="alMayor" checked> <span>Notify the City Mayor</span></label>

            <div class="form-actions"><button type="submit" class="btn btn-primary">Publish alert</button></div>
        </form>

        <aside>
            <div class="phone-label">Public view</div>
            <div class="phone">
                <div class="phone-brand">Agos</div>
                <div class="pv-card">
                    <strong>Flood Alert</strong>
                    <p id="pvLoc"></p>
                    <p>Depth: <span id="pvDepth"></span></p>
                    <p id="pvRoad"></p>
                </div>
                <button type="button" class="btn btn-primary btn-block" id="viewRoute">View safe route</button>
            </div>
        </aside>
    </section>
    <p class="foot-note">Alerts reach residents, commuters, and drivers ahead of time.</p>
</main>
</div>
<?php require __DIR__ . "/../../layouts/footer.php"; ?>
