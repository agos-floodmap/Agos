<?php

require_once __DIR__ . '/../models/db_model.php';

function attemptLogin(string $username, string $password): array
{
    $username = trim($username);
    if ($username === '' || $password === '') {
        return ['ok' => false, 'error' => 'Enter your username and password.'];
    }
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'username' => $username,
        'name'     => ucfirst($username),
        'initials' => strtoupper(substr($username, 0, 2)),
    ];
    return ['ok' => true];
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();
    header('Location: ../index.php');
    exit;
}

if (basename($_SERVER['SCRIPT_FILENAME']) === 'auth_controller.php') {
    if (($_GET['action'] ?? '') === 'logout') { logout(); }

    if (!empty($_SESSION['user'])) {
        header('Location: cdrrmo/cdrrmo_controller.php?page=flood_reports');
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
                header('Location: cdrrmo/cdrrmo_controller.php?page=flood_reports');
                exit;
            }
            $error = $result['error'];
        }
    }

    $pageTitle   = 'Sign in';
    $bodyClass   = 'auth-page';
    $basePath    = '../';
    $formAction  = 'auth_controller.php';
    $extraScript = <<<'JS'
const pw = document.getElementById('password');
const toggle = document.getElementById('togglePw');
const eye = toggle.querySelector('.icon-eye');
const eyeOff = toggle.querySelector('.icon-eye-off');
toggle.addEventListener('click', () => {
  const show = pw.type === 'password';
  pw.type = show ? 'text' : 'password';
  eye.toggleAttribute('hidden', !show);
  eyeOff.toggleAttribute('hidden', show);
  toggle.setAttribute('aria-pressed', show);
  toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
});
JS;

    require __DIR__ . '/../view/auth/login.php';
}
