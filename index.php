<?php
$dati = [
        "Italia", "Albania", "Cina"
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="output.php" method="post">
    <label for="nome">Nome:</label> <input name="nome" id="nome" type="text"> <br>

    <label for="cognome">Cognome:</label> <input name="cognome" id="cognome" type="text"> <br>

    <label for="email">Email:</label> <input name="email" id="email" type="email"> <br>

    <label for="password">Password:</label> <input name="password" id="password" type="password"> <br>

    <label for="eta">Età:</label> <input name="eta" id="eta" type="number"> <br>

    <label for="sesso">Sesso:</label> <br>
    <input name="sesso" id="sesso" type="radio" value="M"> maschio <br>
    <input name="sesso" id="sesso" type="radio" value="F"> femmina <br>

    <label for="nazionalita">Nazionalità:</label>
    <select name="nazionalita[]" id="nazionalita[]" multiple>
        <?php foreach ($dati as $dato):?>
        <option value="<?= $dato?>"> <?=$dato?> </option>
        <?php endforeach ?>
    </select> <br>

    <input type="submit">
</form>
</body>
</html>
