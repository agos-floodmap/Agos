<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function attemptLogin(string $username, string $password): array
{
    $username = trim($username);
    if ($username === '' || $password === '') {
        return ['ok' => false, 'error' => 'Enter your username and password.'];
    }
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'username' => $username,
        'name' => ucfirst($username),
        'role' => 'Barangay Personnel',
        'initials' => strtoupper(substr($username, 0, 2)),
    ];
    return ['ok' => true];
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfValid(?string $token): bool
{
    return !empty($_SESSION['csrf']) && is_string($token) && hash_equals($_SESSION['csrf'], $token);
}
