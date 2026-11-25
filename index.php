<?php
// index.php : Login page
require_once __DIR__ . '/controllers/controller.php';

if (!empty($_SESSION['user'])) {
    header('Location: view/cdrrmo/flood_reports.php');
    exit;
}

$error    = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    if (!csrfValid($_POST['csrf'] ?? null)) {
        $error = 'Your session expired. Reload the page and try again.';
    } else {
        $result = attemptLogin($username, $_POST['password'] ?? '');
        if ($result['ok']) {
            header('Location: view/cdrrmo/flood_reports.php');
            exit;
        }
        $error = $result['error'];
    }
}

$pageTitle   = 'Sign in';
$bodyClass   = 'auth-page';
$basePath    = '';
$extraScript = <<<'JS'
const pw = document.getElementById('password');
const toggle = document.getElementById('togglePw');
toggle.addEventListener('click', () => {
  const show = pw.type === 'password';
  pw.type = show ? 'text' : 'password';
  toggle.textContent = show ? 'Hide' : 'Show';
  toggle.setAttribute('aria-pressed', show);
});
JS;

require __DIR__ . '/layouts/header.php';
?>

<main class="auth-shell">

    <!-- Left: brand + context -->
    <section class="auth-brand" aria-label="About AGOS">
        <div class="brand-row">
            <div class="brand-logo" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round">
                    <path d="M3 8c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1"/>
                    <path d="M3 13c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1"/>
                    <path d="M3 18c2.5-2 4.5-2 7 0s4.5 2 7 0 3-1.5 4-1"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">AGOS</div>
            </div>
        </div>

        <h1 class="brand-headline">Verify flood reports from the field before residents see them.</h1>
        <p class="brand-copy">
            Review reports from volunteers and residents in Baliwag City, confirm water level and
            road passability, and send one alert to the whole community.
        </p>

        <!-- Preview of a report card, matching the dashboard design -->
        <div class="preview-card" aria-hidden="true">
            <div class="preview-head">
                <span class="dot dot-blue"></span>
                <span class="preview-title">Report awaiting review</span>
                <span class="mono-chip">FLD-2026-LPZ01</span>
            </div>
            <div class="preview-body">
                <div class="gauge">
                    <span class="gauge-mark m3">1.5m</span>
                    <span class="gauge-mark m2">1.0m</span>
                    <span class="gauge-water"><span class="gauge-label">Reported: 0.5m</span></span>
                    <span class="gauge-road">Road bed</span>
                </div>
                <div class="preview-meta">
                    <div class="meta-label">Location</div>
                    <div class="meta-value">Lopez Jaena</div>
                    <div class="meta-label">Road status</div>
                    <span class="pill pill-red">Not passable</span>
                    <div class="meta-label">Sent by</div>
                    <div class="meta-value">Mother Leader</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Right: login card -->
    <section class="auth-panel">
        <div class="card login-card">
            <div class="login-head">
                <div class="crumb">Barangay Operations / Sign in</div>
                <h2>Sign in to AGOS</h2>
                <p>For barangay and city personnel. Residents use the mobile app.</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error" role="alert">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16.5v.01"/></svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php" class="login-form" novalidate>
                <input type="hidden" name="csrf" value="<?= csrfToken() ?>">

                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" autocomplete="username"
                           value="<?= htmlspecialchars($username) ?>" placeholder="Enter any username" required autofocus>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" autocomplete="current-password"
                               placeholder="Enter any password" required>
                        <button type="button" id="togglePw" class="input-action" aria-pressed="false">Show</button>
                    </div>
                </div>

                <div class="row-between">
                    <label class="check">
                        <input type="checkbox" name="remember" value="1">
                        <span>Keep me signed in on this device</span>
                    </label>
                    <a href="#" class="link">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>

            <div class="login-foot">
                <span class="mono-chip">Baliwag City</span>
            </div>
        </div>

        <p class="auth-note">Authorized personnel only. Sign-ins are logged.</p>
    </section>

</main>

<?php require __DIR__ . '/layouts/footer.php'; ?>
