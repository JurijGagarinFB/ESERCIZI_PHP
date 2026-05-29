<?php
$basePath = $basePath ?? '';
$appConfig = require __DIR__ . '/../../../Config/appConfig.php';
?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($pageTitle) ? e($pageTitle) : $appConfig['app_name'] ?></title>
        <link rel="stylesheet" href="<?= e($basePath) ?>Public/Style/style.css">
        <?php if (utenteLoggato() && !empty($_SESSION['utente']['colore_sfondo'])): ?>
            <style>
                body { background-color: <?= e($_SESSION['utente']['colore_sfondo']) ?>; }
            </style>
        <?php endif; ?>
    </head>
<body>
    <header class="topbar">
        <div class="container">
            <div class="brand">
                <a href="<?= e($basePath) ?>?page=home">FastRoute</a>
            </div>

            <nav class="nav">
                <a href="<?= e($basePath) ?>?page=home">Home</a>
                <a href="<?= e($basePath) ?>?page=contatti">Contatti</a>

                <?php if (utenteLoggato()): ?>
                    <a href="<?= e($basePath) ?>?page=dashboard">Dashboard</a>
                    <a href="<?= e($basePath) ?>?page=clienti_inserisci">Clienti</a>
                    <a href="<?= e($basePath) ?>?page=plico_accettazione">Accettazione</a>
                    <a href="<?= e($basePath) ?>?page=plico_spedizione">Spedizione</a>
                    <a href="<?= e($basePath) ?>?page=plico_ritiro">Ritiro</a>
                    <a href="<?= e($basePath) ?>?page=stato_plico">Stato plico</a>
                    <a href="<?= e($basePath) ?>?page=statistiche">Statistiche</a>
                    <a href="<?= e($basePath) ?>?page=preferenze">Tema</a>
                    <a href="<?= e($basePath) ?>?page=logout">Logout</a>
                <?php else: ?>
                    <a href="<?= e($basePath) ?>?page=login">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
<?php mostraFlash(); ?>