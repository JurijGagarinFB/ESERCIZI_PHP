<?php
$corsi_selezionati = $_POST["corso"] ?? [];
$docenti_selezionati = $_POST["docente"] ?? [];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Dati Processati</title>
</head>
<body>
<h1>Dati Processati</h1>
<table>
    <tr>
        <th>Docenti</th>
        <th>Corso</th>
    </tr>

    <?php foreach ($corsi_selezionati as $indice => $nome_corso): ?>
        <tr>
            <td>
                <?php
                $docenti_del_corso = $docenti_selezionati[$indice] ?? [];

                if (!empty($docenti_del_corso)) {
                    echo implode(", ", $docenti_del_corso);
                } else {
                    echo "Nessun docente";
                }
                ?>
            </td>
            <td><?= $nome_corso ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>