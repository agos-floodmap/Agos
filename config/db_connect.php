<?php

function loadEnvIfExists(string $envPath): void
{
    if (!is_file($envPath)) {
        return;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $trimmed = trim($line);
        if ($trimmed === '' || str_starts_with($trimmed, '#') || !str_contains($trimmed, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $trimmed, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        if ($key !== '' && getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

function getDbConnection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    // Loads C:\laragon\www\agos\.env locally; skipped safely on Render
    loadEnvIfExists(dirname(__DIR__) . '/.env');

    $host = getenv('DB_HOST') ?: '';
    $port = getenv('DB_PORT') ?: '5432';
    $dbname = getenv('DB_DATABASE') ?: 'postgres';
    $user = getenv('DB_USERNAME') ?: '';
    $password = getenv('DB_PASSWORD') ?: '';
    $sslmode = getenv('DB_SSLMODE') ?: 'require';

    if ($host === '' || $user === '') {
        throw new RuntimeException('Missing Supabase database environment variables.');
    }

    $dsn = sprintf(
        'pgsql:host=%s;port=%s;dbname=%s;sslmode=%s',
        $host,
        $port,
        $dbname,
        $sslmode
    );

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}