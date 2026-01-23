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
    <title>Form</title>
</head>
<body>
<form method="post" action="process.php">
    <label for="nome">Nome</label>
    <input id="nome" type="text" name="nome">
    <br>

    <label for="cognome">Cognome</label>
    <input id="cognome" type="text" name="cognome">
    <br>

    <label for="email">Email</label>
    <input id="email" type="email" name="email">
    <br>

    <label for="password">Password</label>
    <input id="password" type="password" name="password">
    <br>

    <label for="eta">Età</label>
    <input id="eta" type="number" name="eta">
    <br>
    <br>

    <label for="sesso">Sesso</label>
    <input id="sessoM" type="radio" name="sesso" value="M"> <label for="sessoM">Maschio</label>
    <input id="sessoF" type="radio" name="sesso" value="F"> <label for="sessoF">Femmina</label>
    <br>
    <br>

    <label for="corso">Corso</label> <br>
    <input id="corsoSistemi" type="checkbox" name="corso[]" value="Sistemi"> <label for="corsoSistemi">Sistemi</label>
    <br>
    <input id="corsoInformatica" type="checkbox" name="corso[]" value="Informatica"> <label for="corsoInformatica">Informatica</label>
    <br>
    <input id="corsoTPSIT" type="checkbox" name="corso[]" value="TPSIT"> <label for="corsoTPSIT">TPSIT</label> <br>
    <br>
    <br>

    <label for="citta">Città</label>
    <label>
        <select name="citta">
            <option value="Roma">Roma</option>
            <option value="Milano">Milano</option>
            <option value="Napoli">Napoli</option>
            <option value="Torino">Torino</option>
            <option value="Verona">Verona</option>
            <option value="Genova">Genova</option>
            <option value="Bologna">Bologna</option>
            <option value="Cagliari">Cagliari</option>
            <option value="Palermo">Palermo</option>
            <option value="Firenze">Firenze</option>
            <option value="Parma">Parma</option>
            <option value="Modena">Modena</option>
            <option value="Venezia">Venezia</option>
            <option value="Rimini">Rimini</option>
            <option value="Brindisi">Brindisi</option>
            <option value="Bergamo">Bergamo</option>
            <option value="Campobasso">Campobasso</option>
            <option value="Siena">Siena</option>
            <option value="Ancona">Ancona</option>
            <option value="Ascoli Piceno">Ascoli Piceno</option>
            <option value="Catania">Catania</option>
            <option value="Foggia">Foggia</option>
            <option value="Perugia">Perugia</option>
            <option value="Taranto">Taranto</option>
            <option value="Trieste">Trieste</option>
            <option value="Udine">Udine</option>
            <option value="Viterbo">Viterbo</option>
            <option value="Vicenza">Vicenza</option>
            <option value="Livorno">Livorno</option>
            <option value="Lucca">Lucca</option>
            <option value="Brindisi">Brindisi</option>
            <option value="Pavia">Pavia</option>
            <option value="Rovigo">Rovigo</option>
        </select>
    </label>
    <br>
    <br>

    <label for="lingua">Lingua</label>
    <select name="lingua[]" multiple>
        <option value="Inglese">Inglese</option>
        <option value="Francese">Francese</option>
        <option value="Esperanto">Esperanto</option>
        <option value="Italiano">Italiano</option>
        <option value="Giapponese">Giapponese</option>
        <option value="Spagnolo">Spagnolo</option>
        <option value="Tedesco">Tedesco</option>
        <option value="Cinese">Cinese</option>
        <option value="Russo">Russo</option>
        <option value="Portoghese">Portoghese</option>
        <option value="Arabo">Arabo</option>
        <option value="Hindi">Hindi</option>
        <option value="Japonese">Japonese</option>
        <option value="Coreano">Coreano</option>
        <option value="Polacco">Polacco</option>
        <option value="Croato">Croato</option>
        <option value="Slovacco">Slovacco</option>
        <option value="Sloveno">Sloveno</option>
        <option value="Ucraino">Ucraino</option>
        <option value="Bielorussia">Bielorussia</option>
        <option value="Romeno">Romeno</option>
        <option value="Albanese">Albanese</option>
        <option value="Cazaco">Cazaco</option>
        <option value="Macedone">Macedone</option>
        <option value="Serbo">Serbo</option>
    </select>
    <br>
    <br>

    <label for="messaggio">Messaggio</label>
    <label for="message"></label><textarea name="messaggio" id="message" cols="30" rows="10"></textarea>
    <br>

    <input type="submit" value="Invia">
</form>
</body>
</html>
