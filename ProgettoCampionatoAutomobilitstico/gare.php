<?php
declare(strict_types=1);

require_once __DIR__ . "/Functons/bootstrap.php";

$title = "Gare";
$pageTitle = "Gestione gare e risultati";
$activePage = "gare";

$db = db();
$errors = [];

if (!$db) {
    $errors[] = "Connessione al database non disponibile.";
}

$selectedGaraId = (int)($_GET["gara_id"] ?? 0);
$editRaceId = (int)($_GET["edit"] ?? 0);
$editResultGaraId = (int)($_GET["edit_result_gara"] ?? 0);
$editResultPilotaId = (int)($_GET["edit_result_pilota"] ?? 0);

if ($editResultGaraId > 0) {
    $selectedGaraId = $editResultGaraId;
}

if ($db && $_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    try {
        if ($action === "race_create" || $action === "race_update") {
            $idGara = (int)($_POST["id_gara"] ?? 0);
            $nomeGara = trim($_POST["nome_gara"] ?? "");
            $circuito = trim($_POST["circuito"] ?? "");
            $data = trim($_POST["data"] ?? "");

            if ($nomeGara === "" || $circuito === "" || $data === "") {
                $errors[] = "Compila tutti i campi della gara.";
            } else {
                if ($action === "race_create") {
                    $stmt = $db->prepare("INSERT INTO gare (nome_gara, circuito, data) VALUES (?, ?, ?)");
                    $stmt->execute([$nomeGara, $circuito, $data]);
                } else {
                    $stmt = $db->prepare("UPDATE gare SET nome_gara = ?, circuito = ?, data = ? WHERE id_gara = ?");
                    $stmt->execute([$nomeGara, $circuito, $data, $idGara]);
                }
                redirect("/gare.php");
            }
        }

        if ($action === "race_delete") {
            $idGara = (int)($_POST["id_gara"] ?? 0);
            if ($idGara > 0) {
                $stmt = $db->prepare("DELETE FROM gare WHERE id_gara = ?");
                $stmt->execute([$idGara]);
                redirect("/gare.php");
            }
        }

        if ($action === "result_create" || $action === "result_update") {
            $idGara = (int)($_POST["id_gara"] ?? 0);
            $idPilota = (int)($_POST["id_pilota"] ?? 0);
            $posizione = (int)($_POST["posizione"] ?? 0);
            $punti = (int)($_POST["punti_ottenuti"] ?? 0);
            $tempo = trim($_POST["tempo_gara"] ?? "");

            if ($tempo !== "" && strlen($tempo) === 5) {
                $tempo .= ":00";
            }

            $tempoDb = $tempo === "" ? null : $tempo;

            if ($idGara <= 0 || $idPilota <= 0 || $posizione <= 0 || $punti < 0) {
                $errors[] = "Compila tutti i campi del risultato.";
            } else {
                if ($action === "result_create") {
                    $stmt = $db->prepare(
                        "INSERT INTO partecipazione (id_gara, id_pilota, posizione, punti_ottenuti, tempo_gara)
                         VALUES (?, ?, ?, ?, ?)"
                    );
                    $stmt->execute([$idGara, $idPilota, $posizione, $punti, $tempoDb]);
                } else {
                    $stmt = $db->prepare(
                        "UPDATE partecipazione
                         SET posizione = ?, punti_ottenuti = ?, tempo_gara = ?
                         WHERE id_gara = ? AND id_pilota = ?"
                    );
                    $stmt->execute([$posizione, $punti, $tempoDb, $idGara, $idPilota]);
                }
                redirect("/gare.php?gara_id=" . $idGara);
            }
        }

        if ($action === "result_delete") {
            $idGara = (int)($_POST["id_gara"] ?? 0);
            $idPilota = (int)($_POST["id_pilota"] ?? 0);
            if ($idGara > 0 && $idPilota > 0) {
                $stmt = $db->prepare("DELETE FROM partecipazione WHERE id_gara = ? AND id_pilota = ?");
                $stmt->execute([$idGara, $idPilota]);
                redirect("/gare.php?gara_id=" . $idGara);
            }
        }
    } catch (PDOException $e) {
        $errors[] = "Operazione non riuscita: " . $e->getMessage();
    }
}

$races = [];
$piloti = [];
$raceResults = [];
$editRace = null;
$editResult = null;
$fastestResult = null;

if ($db) {
    $stmt = $db->query("SELECT * FROM gare ORDER BY data DESC, nome_gara");
    $races = $stmt->fetchAll();

    $stmt = $db->query(
        "SELECT p.id_pilota, p.nome, p.cognome, p.numero, c.nome AS casa_nome
         FROM piloti p
         JOIN case_automobilistiche c ON p.id_casa = c.id_casa
         ORDER BY p.cognome, p.nome"
    );
    $piloti = $stmt->fetchAll();

    if ($editRaceId > 0) {
        $stmt = $db->prepare("SELECT * FROM gare WHERE id_gara = ?");
        $stmt->execute([$editRaceId]);
        $editRace = $stmt->fetch();
    }

    if ($editResultGaraId > 0 && $editResultPilotaId > 0) {
        $stmt = $db->prepare("SELECT * FROM partecipazione WHERE id_gara = ? AND id_pilota = ?");
        $stmt->execute([$editResultGaraId, $editResultPilotaId]);
        $editResult = $stmt->fetch();
    }

    if ($selectedGaraId === 0 && !empty($races)) {
        $selectedGaraId = (int)$races[0]->id_gara;
    }

    if ($selectedGaraId > 0) {
        $stmt = $db->prepare(
            "SELECT pa.*, p.nome, p.cognome, p.numero, c.nome AS casa_nome
             FROM partecipazione pa
             JOIN piloti p ON pa.id_pilota = p.id_pilota
             JOIN case_automobilistiche c ON p.id_casa = c.id_casa
             WHERE pa.id_gara = ?
             ORDER BY pa.posizione ASC"
        );
        $stmt->execute([$selectedGaraId]);
        $raceResults = $stmt->fetchAll();

        $stmt = $db->prepare(
            "SELECT p.nome, p.cognome, pa.tempo_gara
             FROM partecipazione pa
             JOIN piloti p ON pa.id_pilota = p.id_pilota
             WHERE pa.id_gara = ? AND pa.tempo_gara IS NOT NULL
             ORDER BY pa.tempo_gara ASC
             LIMIT 1"
        );
        $stmt->execute([$selectedGaraId]);
        $fastestResult = $stmt->fetch();
    }
}

ob_start();
?>
    <section class="card">
        <h2><?= $editRace ? "Modifica gara" : "Nuova gara" ?></h2>
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <div><?= h($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-grid">
                <label class="form-field">
                    Nome gara
                    <input type="text" name="nome_gara" required value="<?= h($editRace?->nome_gara ?? "") ?>">
                </label>
                <label class="form-field">
                    Circuito
                    <input type="text" name="circuito" required value="<?= h($editRace?->circuito ?? "") ?>">
                </label>
                <label class="form-field">
                    Data
                    <input type="date" name="data" required value="<?= h($editRace?->data ?? "") ?>">
                </label>
            </div>
            <div class="form-actions right">
                <input type="hidden" name="action" value="<?= $editRace ? "race_update" : "race_create" ?>">
                <?php if ($editRace) : ?>
                    <input type="hidden" name="id_gara" value="<?= (int)$editRace->id_gara ?>">
                <?php endif; ?>
                <button class="btn" type="submit"><?= $editRace ? "Salva modifiche" : "Inserisci" ?></button>
                <?php if ($editRace) : ?>
                    <a class="btn ghost" href="/gare.php">Annulla</a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="card">
        <h2>Elenco gare</h2>
        <?php if (empty($races)) : ?>
            <p class="notice">Nessuna gara registrata.</p>
        <?php else : ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gara</th>
                        <th>Circuito</th>
                        <th>Data</th>
                        <th>Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($races as $race) : ?>
                        <tr>
                            <td><?= (int)$race->id_gara ?></td>
                            <td><?= h($race->nome_gara) ?></td>
                            <td><?= h($race->circuito) ?></td>
                            <td><?= h($race->data) ?></td>
                            <td>
                                <div class="row-actions">
                                    <a class="btn ghost" href="/gare.php?edit=<?= (int)$race->id_gara ?>">Modifica</a>
                                    <form method="post" onsubmit="return confirm('Eliminare la gara?');">
                                        <input type="hidden" name="action" value="race_delete">
                                        <input type="hidden" name="id_gara" value="<?= (int)$race->id_gara ?>">
                                        <button class="btn secondary" type="submit">Elimina</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

    <section class="card">
        <h2>Risultati gara</h2>
        <form method="get" class="form-actions">
            <label class="form-field">
                Seleziona gara
                <select name="gara_id" required>
                    <option value="">Scegli...</option>
                    <?php foreach ($races as $race) : ?>
                        <option value="<?= (int)$race->id_gara ?>" <?= $selectedGaraId === (int)$race->id_gara ? "selected" : "" ?>>
                            <?= h($race->nome_gara) ?> (<?= h($race->data) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button class="btn secondary" type="submit">Mostra risultati</button>
        </form>

        <?php if ($selectedGaraId > 0) : ?>
            <?php if (!empty($fastestResult)) : ?>
                <p class="pill">
                    Tempo più veloce: <?= h($fastestResult->tempo_gara) ?>
                    (<?= h($fastestResult->nome . " " . $fastestResult->cognome) ?>)
                </p>
            <?php else : ?>
                <p class="notice">Nessun tempo registrato per questa gara.</p>
            <?php endif; ?>

            <?php if (empty($raceResults)) : ?>
                <p class="notice">Nessun risultato registrato per questa gara.</p>
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
                            <th>Tempo gara</th>
                            <th>Azioni</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($raceResults as $result) : ?>
                            <tr>
                                <td><?= (int)$result->posizione ?></td>
                                <td><?= h($result->nome . " " . $result->cognome) ?></td>
                                <td><?= (int)$result->numero ?></td>
                                <td><?= h($result->casa_nome) ?></td>
                                <td><?= (int)$result->punti_ottenuti ?></td>
                                <td><?= h($result->tempo_gara ?? "-") ?></td>
                                <td>
                                    <div class="row-actions">
                                        <a class="btn ghost" href="/gare.php?gara_id=<?= (int)$selectedGaraId ?>&edit_result_gara=<?= (int)$selectedGaraId ?>&edit_result_pilota=<?= (int)$result->id_pilota ?>">
                                            Modifica
                                        </a>
                                        <form method="post" onsubmit="return confirm('Eliminare il risultato?');">
                                            <input type="hidden" name="action" value="result_delete">
                                            <input type="hidden" name="id_gara" value="<?= (int)$selectedGaraId ?>">
                                            <input type="hidden" name="id_pilota" value="<?= (int)$result->id_pilota ?>">
                                            <button class="btn secondary" type="submit">Elimina</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <p class="notice">Seleziona una gara per visualizzare i risultati.</p>
        <?php endif; ?>
    </section>

    <section class="card">
        <h2><?= $editResult ? "Modifica risultato" : "Aggiungi risultato" ?></h2>
        <?php if ($selectedGaraId === 0) : ?>
            <p class="notice">Seleziona una gara per inserire un risultato.</p>
        <?php elseif (empty($piloti)) : ?>
            <p class="notice">Nessun pilota disponibile. Inserisci i piloti prima dei risultati.</p>
        <?php else : ?>
            <form method="post">
                <div class="form-grid">
                    <?php if ($editResult) : ?>
                        <div class="form-field">
                            Pilota
                            <div class="pill">
                                <?php
                                $pilotaSelezionato = null;
                                foreach ($piloti as $pilota) {
                                    if ((int)$pilota->id_pilota === (int)$editResult->id_pilota) {
                                        $pilotaSelezionato = $pilota;
                                        break;
                                    }
                                }
                                ?>
                                <?= h(($pilotaSelezionato->nome ?? "") . " " . ($pilotaSelezionato->cognome ?? "")) ?>
                            </div>
                        </div>
                        <input type="hidden" name="id_pilota" value="<?= (int)$editResult->id_pilota ?>">
                    <?php else : ?>
                        <label class="form-field">
                            Pilota
                            <select name="id_pilota" required>
                                <option value="">Seleziona...</option>
                                <?php foreach ($piloti as $pilota) : ?>
                                    <option value="<?= (int)$pilota->id_pilota ?>">
                                        <?= h($pilota->nome . " " . $pilota->cognome) ?> (#<?= (int)$pilota->numero ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    <?php endif; ?>
                    <label class="form-field">
                        Posizione
                        <input type="number" name="posizione" min="1" required value="<?= h((string)($editResult?->posizione ?? "")) ?>">
                    </label>
                    <label class="form-field">
                        Punti ottenuti
                        <input type="number" name="punti_ottenuti" min="0" required value="<?= h((string)($editResult?->punti_ottenuti ?? "")) ?>">
                    </label>
                    <label class="form-field">
                        Tempo gara (HH:MM:SS)
                        <input type="time" name="tempo_gara" step="1" value="<?= h((string)($editResult?->tempo_gara ?? "")) ?>">
                    </label>
                </div>
                <div class="form-actions right">
                    <input type="hidden" name="action" value="<?= $editResult ? "result_update" : "result_create" ?>">
                    <input type="hidden" name="id_gara" value="<?= (int)$selectedGaraId ?>">
                    <button class="btn" type="submit"><?= $editResult ? "Salva risultato" : "Inserisci risultato" ?></button>
                    <?php if ($editResult) : ?>
                        <a class="btn ghost" href="/gare.php?gara_id=<?= (int)$selectedGaraId ?>">Annulla</a>
                    <?php endif; ?>
                </div>
            </form>
        <?php endif; ?>
    </section>
<?php
$content = ob_get_clean();
require __DIR__ . "/Public/Layout/layout.tpl.php";