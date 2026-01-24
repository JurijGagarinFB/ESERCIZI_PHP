<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Numero Corsi</title>
</head>
<body>
<form method="post" action="iscrizione_corsi.php">
    <label for="numerocorsi">Inserire numero di corsi:</label>
    <input id="numerocorsi" type="number" name="numerocorsi" min="1" max="10">
    <br>

    <input type="submit" value="Invia">
</form>
</body>
</html>
