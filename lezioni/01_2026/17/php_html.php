<?php
$var = "ciao mondo, questa è una variabile php";
$num = 12;
$dis = "dispari";
$par = "pari";
$materie = ["informatica", "gpoi", "sistemi", "tpsit"];
$messaggio = "sono il contenuto di una variabile php iniettato in javascript";
$studenti = [
        [
                "nome" => "Mario",
                "cognome" => "Rossi",
                "media" => 8.5

        ],
        [
                "nome" => "Paolo",
                "cognome" => "Bianchi",
                "media" => 6.5
        ],
        [
                "nome" => "Luigi",
                "cognome" => "Verdi",
                "media" => 9.5
        ]
];
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
<p>questo è un p</p>
<p><?php echo $var ?></p>
<p><?= $var ?></p> <!-- versione compatta dell'echo, funziona solo per stampare -->

<!-- istruzioni -->
<?php if ($num % 2 == 0): ?>
    <h1><?= $par ?></h1>
<?php else: ?>
    <h1><?= $dis ?></h1>
<?php endif; ?>

<?php foreach ($materie as $materia): ?>
    <li><?= $materia ?></li>
    <hr>
<?php endforeach; ?>

<p><?= $studenti[0]["nome"] ?></p>


<?php while ($num > 0): ?>
    <p><?= $num ?></p>
    <?php $num-- ?>
<?php endwhile; ?>

<hr>
<table>
    <thead>
    <tr>
        <?php foreach ($studenti[0] as $key => $value): ?>
            <th><?= $key ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($studenti as $studente): ?>
        <tr>
            <?php foreach ($studente as $value): ?>
                <td><?= $value ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<hr>

<button id="mybutton">clicca qui</button>
<script>messaggio = <?= json_encode($messaggio) ?></script>
<script src=script.js></script>

</body>
</html>