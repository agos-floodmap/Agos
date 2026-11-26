<?php require __DIR__ . "/../../layouts/header.php"; ?>
<div class="app-shell">
    <?php require __DIR__ . "/../../layouts/sidebar.php"; ?>
    <div class="main-content">
        <?php require __DIR__ . "/../../layouts/topbar.php"; ?>
        <main class="content">
            <section class="page-head">
                <div>
                    <div class="crumb">CDRRMO / <span class="link-blue">Hazard map</span></div>
                    <h1>City Areas and Roads</h1>
                </div>
            </section>

            <section class="card panel">
                <div class="table-wrap">
                    <table class="table" id="arTable">
                        <thead>
                            <tr>
                                <th>Area or road</th>
                                <th>Water</th>
                                <th>Road status</th>
                                <th>Updated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r): ?>
                                <tr data-area="<?= htmlspecialchars($r["area"]) ?>"
                                    data-water="<?= $r["water"] ?>"
                                    data-road="<?= $r["road"] ?>"
                                    data-status="<?= $r["status"] ?>">
                                    <td><strong><?= htmlspecialchars($r["area"]) ?></strong></td>
                                    <td class="c-water mono"><?= $r["water"] ?></td>
                                    <td class="c-road"><?= $r["road"] ?></td>
                                    <td class="c-updated"><?= $r["updated"] ?></td>
                                    <td><button class="link-btn" data-edit>Edit</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="edit-panel" id="editPanel">
                    <h2 id="editTitle">Update area</h2>
                    <div class="edit-grid">
                        <div class="field">
                            <label for="arWater">Water level</label>
                            <input type="text" id="arWater" class="input" placeholder="e.g. 0.5 m">
                        </div>
                        <fieldset class="radios">
                            <legend>Road status</legend>
                            <label><input type="radio" name="road" value="Passable"> Passable</label>
                            <label><input type="radio" name="road" value="Not passable to light vehicles"> Not passable to light vehicles</label>
                            <label><input type="radio" name="road" value="Not passable"> Not passable</label>
                        </fieldset>
                        <fieldset class="radios">
                            <legend>Area status</legend>
                            <label><input type="radio" name="area" value="Affected"> Affected</label>
                            <label><input type="radio" name="area" value="Cleared"> Cleared</label>
                        </fieldset>
                    </div>
                    <div class="edit-actions">
                        <button class="btn btn-primary" id="arSave">Save changes</button>
                    </div>
                </div>
            </section>

            <p class="foot-note">Personnel update affected areas and road passability.</p>
        </main>
    </div>
</div>
<?php require __DIR__ . "/../../layouts/footer.php"; ?>
