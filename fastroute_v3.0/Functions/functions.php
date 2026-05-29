<?php
function e($stringa) {
    return htmlspecialchars($stringa, ENT_QUOTES, 'UTF-8');
}

function utenteLoggato() {
    return isset($_SESSION['utente']);
}

function impostaFlash($tipo, $messaggio) {
    $_SESSION['flash'][$tipo] = $messaggio;
}

function mostraFlash() {
    if (isset($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $messaggio) {
            echo "<div class='flash flash-{$tipo}'>" . e($messaggio) . "</div>";
        }
        unset($_SESSION['flash']);
    }
}

function passwordValida($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/', $password);
}

function statoBadgeClass($stato) {
    switch ($stato) {
        case 'in partenza': return 'badge-azzurro';
        case 'in transito': return 'badge-giallo';
        case 'ritirato': return 'badge-verde';
        default: return '';
    }
}

function redirect($url) {
    header("Location: " . $url);
    exit;
}