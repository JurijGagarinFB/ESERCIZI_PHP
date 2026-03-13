<?php
declare(strict_types=1);

require_once __DIR__ . "/Functons/bootstrap.php";

$title = "Classifica generale";
$pageTitle = "Classifiche generali";
$activePage = "classifica";

$db = db();
$errors = [];

if (!$db) {
    $errors[] = "Connessione al database non disponibile.";
}

$driverStandings = [];
$teamStandings = [];

if ($db) {
    $stmt = $db->query(
        "SELECT p.id_pilota, p.nome, p.cognome, p.numero, c.nome AS casa_nome,
                COALESCE(SUM(pa.punti_ottenuti), 0) AS punti
         FROM piloti p
         JOIN case_automobilistiche c ON p.id_casa = c.id_casa
         LEFT JOIN partecipazione pa ON pa.id_pilota = p.id_pilota
         GROUP BY p.id_pilota
         ORDER BY punti DESC, p.cognome, p.nome"
    );
    $driverStandings = $stmt->fetchAll();

    $stmt = $db->query(
        "SELECT c.id_casa, c.nome, c.colore_livrea,
                COALESCE(SUM(pa.punti_ottenuti), 0) AS punti,
                COUNT(DISTINCT p.id_pilota) AS numero_piloti
         FROM case_automobilistiche c
         LEFT JOIN piloti p ON p.id_casa = c.id_casa
         LEFT JOIN partecipazione pa ON pa.id_pilota = p.id_pilota
         GROUP BY c.id_casa
         ORDER BY punti DESC, c.nome"
    );
    $teamStandings = $stmt->fetchAll();
}

ob_start();
?>
<?php if (!empty($errors)) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <div><?= h($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    <section class="card">
        <h2>Classifica piloti</h2>
        <?php if (empty($driverStandings)) : ?>
            <p class="notice">Nessun pilota registrato.</p>
        <?php else : ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Posizione</th>
                        <th>Pilota</th>
                        <th>Numero</th>
                        <th>Casa</th>
                        <th>Punti</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($driverStandings as $index => $pilota) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= h($pilota->nome . " " . $pilota->cognome) ?></td>
                            <td><?= (int)$pilota->numero ?></td>
                            <td><?= h($pilota->casa_nome) ?></td>
                            <td><?= (int)$pilota->punti ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

    <section class="card">
        <h2>Classifica squadre</h2>
        <?php if (empty($teamStandings)) : ?>
            <p class="notice">Nessuna casa automobilistica registrata.</p>
        <?php else : ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Posizione</th>
                        <th>Casa</th>
                        <th>Piloti</th>
                        <th>Punti</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teamStandings as $index => $team) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= h($team->nome) ?></td>
                            <td><?= (int)$team->numero_piloti ?></td>
                            <td><?= (int)$team->punti ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
<?php
$content = ob_get_clean();
require __DIR__ . "/Public/Layout/layout.tpl.php";