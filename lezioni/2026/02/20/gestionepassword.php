<?php
/**
 ** no psw in chiaro nel database, solo criptate
 ** pswutente -> metodo di hashing -> codice alfanumerico (digest)
 ** il digest ha una lunghezza fissa, varia totalmente al minimo cambiamento di pswutente, non è decifrabile
 ** nel metodo di hash moderno viene aggiunto anche un numero casuale (salt)
 */

$psw = "password1234";
$hash = password_hash($psw, PASSWORD_DEFAULT);
echo $hash;
echo "<br>";
echo strlen($hash);
echo "<br>";

$psw = "password1234sbagliata";
if (password_verify($psw, $hash)) {
    echo "password corretta";
} else {
    echo "password errata";
}
