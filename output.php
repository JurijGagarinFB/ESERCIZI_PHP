<?php
$nome = $_POST["nome"] ?? "";
$cognome = $_POST["cognome"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$eta = $_POST["eta"] ?? "";
$sesso = $_POST["sesso"] ?? "";
$nazionalita = $_POST["nazionalita"] ?? [];

$hash = password_hash($password, PASSWORD_DEFAULT);

$dati = [
    "nome" => $nome,
    "cognome" => $cognome,
    "email" => $email,
    "password" => $hash,
    "eta" => $eta,
    "sesso" => $sesso,
    "nazionalita" => $nazionalita
];

$str = implode("|", $dati) . "\n";
file_put_contents("dati.txt", $str, FILE_APPEND);
$righe = file("dati.txt");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <?php foreach ($dati as $dato => $value): ?>
            <th><?= $dato ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($righe as $dato): ?>
        <tr>
            <?php $colonne = explode("|", $dato) ?>
            <?php foreach ($colonne as $colonna): ?>
                <th>
                    <?= $colonna ?>
                </th>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
