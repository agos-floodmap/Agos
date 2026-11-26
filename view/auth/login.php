<?php
$error      = $error ?? '';
$username   = $username ?? '';
$formAction = $formAction ?? '../../controllers/auth_controller.php';

require __DIR__ . '/../../layouts/header.php';
?>

<main class="auth-shell">

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
    </section>

    <section class="auth-panel">
        <div class="card login-card">
            <div class="login-head">
                <h2>Welcome</h2>
                <p>Log in to manage flood reports and community alerts.</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error" role="alert">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16.5v.01"/></svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= htmlspecialchars($formAction) ?>" class="login-form" novalidate>
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
                        <button type="button" id="togglePw" class="input-action" aria-pressed="false" aria-label="Show password">
                            <svg class="icon-eye" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" hidden>
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg class="icon-eye-off" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="row-between">
                    <label class="check">
                        <input type="checkbox" name="remember" value="1">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="link">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>

        <p class="auth-note">Authorized personnel only. Sign-ins are logged.</p>
    </section>

</main>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>
