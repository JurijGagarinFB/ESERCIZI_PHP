<?php
$nome = $_POST["nome"] ?? " "; //$_POST è una superglobale, contiene tutti i dati inviati tramite POST dal form

$cognome = $_POST["cognome"] ?? " ";

$email = $_POST["email"] ?? " ";

$password = $_POST["password"] ?? " ";

$eta = $_POST["eta"] ?? " ";

$sesso = $_POST["sesso"] ?? " ";

$corso = $_POST["corso"] ?? [];

$citta = $_POST["citta"] ?? " ";

$lingua = $_POST["lingua"] ?? " ";

$messaggio = $_POST["messaggio"] ?? " ";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dati Processati</title>
</head>
<body>
<h1>Dati Processati</h1>
<p>Nome: <?php echo $nome; ?></p>
<p>Cognome: <?php echo $cognome; ?></p>
<p>Email: <?php echo $email; ?></p>
<p>Età: <?php echo $eta; ?></p>
<p>Sesso: <?php echo $sesso; ?></p>
<p>Corso:</p>
<?php foreach ($corso as $corso_selezionato) { ?>
    <p><?php echo $corso_selezionato; ?></p>
<?php } ?>
<p>Citta: <?php echo $citta; ?></p>
<?php foreach ($lingua as $lingua_selezionata) { ?>
    <p><?php echo $lingua_selezionata; ?></p>
<?php } ?>
<p>Messaggio: <?php echo $messaggio; ?></p>
</body>
</html>
