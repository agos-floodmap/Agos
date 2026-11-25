<?php

$basePath = $basePath ?? '';
$withApp = $withApp ?? false;
?>
<?php if ($withApp): ?>
    <div class="toast-stack" id="toasts" aria-live="polite"></div>
    <div class="modal-backdrop" id="modal" hidden>
        <div class="modal card" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <h3 id="modalTitle"></h3>
            <div id="modalBody"></div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-action="modal-cancel">Cancel</button>
                <button class="btn btn-primary" id="modalConfirm" data-action="modal-confirm">Confirm</button>
            </div>
        </div>
    </div>
    <script src="<?= $basePath ?>assets/app.js"></script>
<?php endif; ?>
<?php if (!empty($extraScript)): ?>
    <script><?= $extraScript ?></script>
<?php endif; ?>
</body>

</html>