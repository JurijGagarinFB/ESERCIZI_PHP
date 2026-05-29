<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Europe/Rome');

require_once __DIR__ . '/../Functions/functions.php';
require_once __DIR__ . '/../vendor/autoload.php';