<?php
declare(strict_types=1);

require_once __DIR__ . "/Functons/bootstrap.php";

$title = "Case automobilistiche";
$pageTitle = "Gestione case automobilistiche";
$activePage = "case";

$db = db();
$errors = [];

if (!$db) {
    $errors[] = "Connessione al database non disponibile.";
}

if ($db && $_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    $nome = trim($_POST["nome"] ?? "");
    $colore = trim($_POST["colore_livrea"] ?? "");
    $idCasa = (int)($_POST["id_casa"] ?? 0);

    try {
        if ($action === "create") {
            if ($nome === "" || $colore === "") {
                $errors[] = "Compila tutti i campi richiesti.";
            } else {
                $stmt = $db->prepare("INSERT INTO case_automobilistiche (nome, colore_livrea) VALUES (?, ?)");
                $stmt->execute([$nome, $colore]);
                redirect("/case_automobilistiche.php");
            }
        }

        if ($action === "update") {
            if ($idCasa <= 0 || $nome === "" || $colore === "") {
                $errors[] = "Compila tutti i campi richiesti.";
            } else {
                $stmt = $db->prepare("UPDATE case_automobilistiche SET nome = ?, colore_livrea = ? WHERE id_casa = ?");
                $stmt->execute([$nome, $colore, $idCasa]);
                redirect("/case_automobilistiche.php");
            }
        }

        if ($action === "delete") {
            if ($idCasa > 0) {
                $stmt = $db->prepare("DELETE FROM case_automobilistiche WHERE id_casa = ?");
                $stmt->execute([$idCasa]);
                redirect("/case_automobilistiche.php");
            }
        }
    } catch (PDOException $e) {
        $errors[] = "Operazione non riuscita: " . $e->getMessage();
    }
}

$editId = (int)($_GET["edit"] ?? 0);
$editCasa = null;

if ($db && $editId > 0) {
    $stmt = $db->prepare("SELECT * FROM case_automobilistiche WHERE id_casa = ?");
    $stmt->execute([$editId]);
    $editCasa = $stmt->fetch();
}

$case = [];
if ($db) {
    $stmt = $db->query("SELECT * FROM case_automobilistiche ORDER BY nome");
    $case = $stmt->fetchAll();
}

ob_start();
?>
<section class="card">
    <h2><?= $editCasa ? "Modifica casa automobilistica" : "Nuova casa automobilistica" ?></h2>
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
                Nome
                <input type="text" name="nome" required value="<?= h($editCasa?->nome ?? "") ?>">
            </label>
            <label class="form-field">
                Colore livrea
                <input type="text" name="colore_livrea" required value="<?= h($editCasa?->colore_livrea ?? "") ?>">
            </label>
        </div>
        <div class="form-actions right">
            <input type="hidden" name="action" value="<?= $editCasa ? "update" : "create" ?>">
            <?php if ($editCasa) : ?>
                <input type="hidden" name="id_casa" value="<?= (int)$editCasa->id_casa ?>">
            <?php endif; ?>
            <button class="btn" type="submit"><?= $editCasa ? "Salva modifiche" : "Inserisci" ?></button>
            <?php if ($editCasa) : ?>
                <a class="btn ghost" href="/case_automobilistiche.php">Annulla</a>
            <?php endif; ?>
        </div>
    </form>
</section>

<section class="card">
    <h2>Elenco case automobilistiche</h2>
    <?php if (empty($case)) : ?>
        <p class="notice">Nessuna casa automobilistica registrata.</p>
    <?php else : ?>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Colore livrea</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($case as $casa) : ?>
                    <tr>
                        <td><?= (int)$casa->id_casa ?></td>
                        <td><?= h($casa->nome) ?></td>
                        <td><?= h($casa->colore_livrea) ?></td>
                        <td>
                            <div class="row-actions">
                                <a class="btn ghost" href="/case_automobilistiche.php?edit=<?= (int)$casa->id_casa ?>">Modifica</a>
                                <form method="post" onsubmit="return confirm('Eliminare la casa?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id_casa" value="<?= (int)$casa->id_casa ?>">
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
