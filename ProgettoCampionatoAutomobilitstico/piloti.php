<?php
declare(strict_types=1);

require_once __DIR__ . "/Functons/bootstrap.php";

$title = "Piloti";
$pageTitle = "Gestione piloti";
$activePage = "piloti";

$db = db();
$errors = [];

if (!$db) {
    $errors[] = "Connessione al database non disponibile.";
}

if ($db && $_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    $idPilota = (int)($_POST["id_pilota"] ?? 0);
    $nome = trim($_POST["nome"] ?? "");
    $cognome = trim($_POST["cognome"] ?? "");
    $nazionalita = trim($_POST["nazionalita"] ?? "");
    $numero = (int)($_POST["numero"] ?? 0);
    $idCasa = (int)($_POST["id_casa"] ?? 0);

    try {
        if ($action === "create") {
            if ($nome === "" || $cognome === "" || $nazionalita === "" || $numero <= 0 || $idCasa <= 0) {
                $errors[] = "Compila tutti i campi richiesti.";
            } else {
                $stmt = $db->prepare(
                    "INSERT INTO piloti (nome, cognome, numero, nazionalita, id_casa) VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([$nome, $cognome, $numero, $nazionalita, $idCasa]);
                redirect("/piloti.php");
            }
        }

        if ($action === "update") {
            if ($idPilota <= 0 || $nome === "" || $cognome === "" || $nazionalita === "" || $numero <= 0 || $idCasa <= 0) {
                $errors[] = "Compila tutti i campi richiesti.";
            } else {
                $stmt = $db->prepare(
                    "UPDATE piloti SET nome = ?, cognome = ?, numero = ?, nazionalita = ?, id_casa = ? WHERE id_pilota = ?"
                );
                $stmt->execute([$nome, $cognome, $numero, $nazionalita, $idCasa, $idPilota]);
                redirect("/piloti.php");
            }
        }

        if ($action === "delete") {
            if ($idPilota > 0) {
                $stmt = $db->prepare("DELETE FROM piloti WHERE id_pilota = ?");
                $stmt->execute([$idPilota]);
                redirect("/piloti.php");
            }
        }
    } catch (PDOException $e) {
        $errors[] = "Operazione non riuscita: " . $e->getMessage();
    }
}

$editId = (int)($_GET["edit"] ?? 0);
$editPilota = null;

if ($db && $editId > 0) {
    $stmt = $db->prepare("SELECT * FROM piloti WHERE id_pilota = ?");
    $stmt->execute([$editId]);
    $editPilota = $stmt->fetch();
}

$case = [];
$piloti = [];

if ($db) {
    $stmt = $db->query("SELECT id_casa, nome, colore_livrea FROM case_automobilistiche ORDER BY nome");
    $case = $stmt->fetchAll();

    $stmt = $db->query(
        "SELECT p.*, c.nome AS casa_nome, c.colore_livrea
         FROM piloti p
         JOIN case_automobilistiche c ON p.id_casa = c.id_casa
         ORDER BY p.cognome, p.nome"
    );
    $piloti = $stmt->fetchAll();
}

ob_start();
?>
    <section class="card">
        <h2><?= $editPilota ? "Modifica pilota" : "Nuovo pilota" ?></h2>
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <div><?= h($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($case)) : ?>
            <p class="notice">Prima di inserire un pilota, registra almeno una casa automobilistica.</p>
        <?php endif; ?>

        <form method="post">
            <div class="form-grid">
                <label class="form-field">
                    Nome
                    <input type="text" name="nome" required value="<?= h($editPilota?->nome ?? "") ?>">
                </label>
                <label class="form-field">
                    Cognome
                    <input type="text" name="cognome" required value="<?= h($editPilota?->cognome ?? "") ?>">
                </label>
                <label class="form-field">
                    Nazionalità
                    <input type="text" name="nazionalita" required value="<?= h($editPilota?->nazionalita ?? "") ?>">
                </label>
                <label class="form-field">
                    Numero
                    <input type="number" name="numero" min="1" required value="<?= h((string)($editPilota?->numero ?? "")) ?>">
                </label>
                <label class="form-field">
                    Casa automobilistica
                    <select name="id_casa" required>
                        <option value="">Seleziona...</option>
                        <?php foreach ($case as $casa) : ?>
                            <option value="<?= (int)$casa->id_casa ?>" <?= ($editPilota && (int)$editPilota->id_casa === (int)$casa->id_casa) ? "selected" : "" ?>>
                                <?= h($casa->nome) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <div class="form-actions right">
                <input type="hidden" name="action" value="<?= $editPilota ? "update" : "create" ?>">
                <?php if ($editPilota) : ?>
                    <input type="hidden" name="id_pilota" value="<?= (int)$editPilota->id_pilota ?>">
                <?php endif; ?>
                <button class="btn" type="submit" <?= empty($case) ? "disabled" : "" ?>>
                    <?= $editPilota ? "Salva modifiche" : "Inserisci" ?>
                </button>
                <?php if ($editPilota) : ?>
                    <a class="btn ghost" href="/piloti.php">Annulla</a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="card">
        <h2>Elenco piloti</h2>
        <?php if (empty($piloti)) : ?>
            <p class="notice">Nessun pilota registrato.</p>
        <?php else : ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pilota</th>
                        <th>Numero</th>
                        <th>Nazionalità</th>
                        <th>Casa</th>
                        <th>Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($piloti as $pilota) : ?>
                        <tr>
                            <td><?= (int)$pilota->id_pilota ?></td>
                            <td><?= h($pilota->nome . " " . $pilota->cognome) ?></td>
                            <td><?= (int)$pilota->numero ?></td>
                            <td><?= h($pilota->nazionalita) ?></td>
                            <td><?= h($pilota->casa_nome) ?></td>
                            <td>
                                <div class="row-actions">
                                    <a class="btn ghost" href="/piloti.php?edit=<?= (int)$pilota->id_pilota ?>">Modifica</a>
                                    <form method="post" onsubmit="return confirm('Eliminare il pilota?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id_pilota" value="<?= (int)$pilota->id_pilota ?>">
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
<?php
$content = ob_get_clean();
require __DIR__ . "/Public/Layout/layout.tpl.php";