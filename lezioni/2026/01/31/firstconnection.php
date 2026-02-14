<?php
require "/home/Francesco_Bazaj/Documenti/ESERCIZI_PHP/config/DBConn.php";
$dbconfig = require "/home/Francesco_Bazaj/Documenti/ESERCIZI_PHP/config/DBconfig.php";

$db = DBConn::getDB($dbconfig);

if ($db == null){
    exit("Errore nella connessione al database");
}
/*
$db = new PDO(
    "mysql:host=192.168.60.144;dbname=francesco_bazaj_itis;charset=utf8mb4",
    "francesco_bazaj",
    "rimprovereremmo.scacchi.",
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
);
*/

/*

$query = "SELECT * FROM studenti";

try {
    $stmt = $db->prepare($query);
    $stmt->execute();

    while ($user = $stmt->fetch()) {
        echo "nome: " . $user->nome . "<br>";
        echo "cognome: " . $user->cognome . "<br>";
        echo "data_iscrizione: " . $user->data_iscrizione . "<br>";
        echo "<hr>";
    }
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "Errore nella query. Contattare l'amministratore. Questo messaggio viene visualizzato all'utente.";
}

*/


//READ -------------------------------------------------

$query = "SELECT media, cognome FROM studenti WHERE nome = :name";
try {
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name", "Maria", PDO::PARAM_STR);
    $stmt->execute();

    while ($user = $stmt->fetch()) {
        echo "Media: " . $user->media . "<br>";
        echo "Cognome: " . $user->cognome . "<br>";
        echo "<hr>";
    }
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "Errore nella query. Contattare l'amministratore. Questo messaggio viene visualizzato all'utente.";
}


//CREATE -------------------------------------------------
/*
$query = "INSERT INTO studenti (nome, cognome, media, data_iscrizione) VALUES (:name, :surname, :media, NOW())";

try{
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name", "Francesco", PDO::PARAM_STR);
    $stmt->bindValue(":surname", "Bazaj", PDO::PARAM_STR);
    $stmt->bindValue(":media", 10, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "Errore nella query. Contattare l'amministratore. Questo messaggio viene visualizzato all'utente.";
}
*/

//UPDATE -------------------------------------------------
/*
$query = 'UPDATE studenti
SET media = :media
WHERE nome = :name';

try {
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', 'Antonio', PDO::PARAM_STR);
    $stmt->bindValue(':media', 10, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo "No rows were updated.";
    } else {
        echo "Update successful.";
    }
    echo '<br>';
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo "A database error occurred. Please try again later.";
    echo '<br>';
    echo $e;
    echo '<br>';
}
*/

//DELETE -------------------------------------------------
/*
$query = "DELETE FROM studenti WHERE nome = :name";
try {
    $stmt = $db->prepare($query);
    $stmt->bindValue(":name", "Antonio", PDO::PARAM_STR);
    $stmt->execute();
    echo "Delete successful.";
} catch (PDOException $e) {
    echo "A database error occurred. Please try again later.";
}
*/