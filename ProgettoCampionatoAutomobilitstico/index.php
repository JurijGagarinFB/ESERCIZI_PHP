<?php
require_once __DIR__ . "/Functons/bootstrap.php";

$title = "Home";
$pageTitle = "Campionato Automobilistico";
$activePage = "home";

ob_start();
?>
<div class="split">
    <section class="card">
        <h2>Benvenuto</h2>
        <p>
            Gestisci piloti, case automobilistiche, gare e classifiche generali del campionato.
            Usa la barra laterale per navigare rapidamente tra le sezioni.
        </p>
        <div class="form-actions">
            <a class="btn" href="/piloti.php">Gestisci piloti</a>
            <a class="btn secondary" href="/gare.php">Gestisci gare</a>
        </div>
    </section>
    <section class="card">
        <h2>Funzionalità principali</h2>
        <ul>
            <li>Inserimento e aggiornamento di piloti e case automobilistiche.</li>
            <li>Registrazione dei risultati gara con posizioni, punti e tempi.</li>
            <li>Classifica generale aggiornata per piloti e squadre.</li>
        </ul>
    </section>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . "/Public/Layout/layout.tpl.php";
