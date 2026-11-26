<?php require __DIR__ . "/../../layouts/header.php"; ?>
<div class="app-shell">
    <?php require __DIR__ . "/../../layouts/sidebar.php"; ?>
    <div class="main-content">
        <?php require __DIR__ . "/../../layouts/topbar.php"; ?>
        <main class="content">
            <section class="page-head">
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

                    <fieldset class="checks">
                        <legend>Send to</legend>
                        <label class="check">
                            <input type="checkbox" name="grp" checked>
                            <span>Affected areas first</span>
                        </label>
                        <label class="check">
                            <input type="checkbox" name="grp" checked>
                            <span>Residents of Baliwag City</span>
                        </label>
                        <label class="check">
                            <input type="checkbox" name="grp" checked>
                            <span>Commuters and drivers passing through</span>
                        </label>
                    </fieldset>

                    <label class="notice check">
                        <input type="checkbox" id="alMayor" checked>
                        <span>Notify the City Mayor</span>
                    </label>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Publish alert</button>
                    </div>
                </form>

                <aside>
                    <div class="phone-label">Public view</div>
                    <div class="phone">
                        <div class="phone-status" aria-hidden="true">
                            <span>9:41</span>
                            <span class="phone-notch"></span>
                            <span class="phone-icons">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><circle cx="12" cy="19.5" r="1" fill="currentColor"/></svg>
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="17" height="10" rx="2"/><path d="M22 10v4"/><rect x="4.5" y="9.5" width="11" height="5" rx="1" fill="currentColor" stroke="none"/></svg>
                            </span>
                        </div>
                        <div class="phone-appbar">
                            <span class="phone-logo">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M3 8c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1"/><path d="M3 13c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1"/><path d="M3 18c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1"/></svg>
                            </span>
                            <div>
                                <div class="phone-brand">AGOS</div>
                                <div class="phone-city">Baliwag City</div>
                            </div>
                            <span class="phone-live">LIVE</span>
                        </div>
                        <div class="phone-screen">
                            <div class="pv-card">
                                <div class="pv-badge-row">
                                    <span class="pv-badge">Flood Alert</span>
                                    <span class="pv-time">Just now</span>
                                </div>
                                <strong class="pv-loc" id="pvLoc"></strong>
                                <div class="pv-meta">
                                    <div><span>Water depth</span><strong id="pvDepth"></strong></div>
                                    <div><span>Road status</span><strong id="pvRoad"></strong></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" id="viewRoute">View safe route</button>
                            <div class="pv-tip">
                                <strong>Safety reminder</strong>
                                <p>Avoid flooded streets and follow CDRRMO advisories.</p>
                            </div>
                        </div>
                        <div class="phone-homebar" aria-hidden="true"></div>
                    </div>
                </aside>
            </section>

            <p class="foot-note">Alerts reach residents, commuters, and drivers ahead of time.</p>
        </main>
    </div>
</div>
<?php require __DIR__ . "/../../layouts/footer.php"; ?>
