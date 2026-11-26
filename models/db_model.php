<?php

if (session_status() === PHP_SESSION_NONE) { session_start(); }

function csrfToken(): string
{
    if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }
    return $_SESSION['csrf'];
}

function csrfValid(?string $token): bool
{
    return !empty($_SESSION['csrf']) && is_string($token) && hash_equals($_SESSION['csrf'], $token);
}

function requireLogin(string $basePath = '../'): array
{
    if (empty($_SESSION['user'])) {
        header('Location: ' . $basePath . 'index.php');
        exit;
    }
    return $_SESSION['user'];
}
