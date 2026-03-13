<?php
$title = $title ?? "Campionato";
$pageTitle = $pageTitle ?? $title;
$activePage = $activePage ?? "";

$navItems = [
        "home" => ["label" => "Home", "href" => "/index.php"],
        "piloti" => ["label" => "Piloti", "href" => "/piloti.php"],
        "case" => ["label" => "Case automobilistiche", "href" => "/case_automobilistiche.php"],
        "gare" => ["label" => "Gare", "href" => "/gare.php"],
        "classifica" => ["label" => "Classifica generale", "href" => "/classifica.php"],
];
?>

<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Public/CSS/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/Public/Resources/Images/logo_campionato.png">

    <title><?= htmlspecialchars($title, ENT_QUOTES, "UTF-8") ?></title>
</head>
<body>
<div class="layout">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar__logo">
            <img src="/Public/Resources/Images/logo_campionato.png" alt="Logo campionato">
            <div>
                <div class="sidebar__title">Campionato</div>
                <div class="sidebar__subtitle">Automobilistico</div>
            </div>
        </div>
        <nav class="sidebar__nav">
            <?php foreach ($navItems as $key => $item) : ?>
                <a class="nav-link <?= $key === $activePage ? "active" : "" ?>" href="<?= $item["href"] ?>">
                    <?= htmlspecialchars($item["label"], ENT_QUOTES, "UTF-8") ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <div class="sidebar__footer">
            <a href="https://github.com/JurijGagarinFB/ESERCIZI_PHP/tree/main/ProgettoCampionatoAutomobilitstico" target="_blank" rel="noopener noreferrer">
                JurijGagarinFB
            </a>
        </div>
    </aside>
    <div class="content">
        <header class="content__header">
            <button class="burger" id="burger" aria-label="Apri menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <h1><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>
        </header>
        <main class="content__main">
            <?= $content ?? "" ?>
        </main>
    </div>
</div>
<div class="overlay" id="overlay"></div>
<script src="/Public/JavaScript/app.js"></script>
</body>
</html>