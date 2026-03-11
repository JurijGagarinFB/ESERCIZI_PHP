<?php
declare(strict_types=1);

require_once __DIR__ . "/../Configuration/DBConn.php";

function db(): ?PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = require __DIR__ . "/../Configuration/DBconfig.php";
    $pdo = DBConn::getDB($config);

    return $pdo;
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

function redirect(string $url): void
{
    header("Location: {$url}");
    exit;
}
