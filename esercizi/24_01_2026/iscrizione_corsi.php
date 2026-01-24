<?php
$numerocorsi = $_POST["numerocorsi"];
$corsi = ["Sistemi e reti", "Robotica", "Contabilità", "Meccatronica", "Chimica", "Statistica", "Matematica", "Informatica", "Marketing", "Economia Politica"];
$docenti = ["Emiliano Spiller", "Giovanni Padovani", "Alberto Malengo", "Michele Bononi", "Franz Ferdinand", "Filippo Gasparini"];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Iscrizione Corsi</title>
</head>
<body>
<form method="post" action="process.php">
    <?php for ($i = 0; $i < $numerocorsi; $i++): ?>
        <div class="sezione">
            <h2>Iscrizione corso <?= $i + 1 ?></h2>
            <label for="corso<?= $i ?>">Corso <?= $i + 1 ?></label>
            <select name="corso[]" id="corso<?= $i ?>">
                <?php foreach ($corsi as $corso): ?>
                    <option value="<?= $corso ?>"><?= $corso ?></option>
                <?php endforeach; ?>
            </select>

            <label for="docente<?= $i ?>">Docenti</label>
            <select name="docente[<?= $i ?>][]" id="docente<?= $i ?>" multiple>
                <?php foreach ($docenti as $docente): ?>
                    <option value="<?= $docente ?>"><?= $docente ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
    <?php endfor; ?>

    <input type="submit" value="Invia">
</form>
</body>
</html>