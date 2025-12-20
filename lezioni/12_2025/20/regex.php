<?php
/**
 * 1. Regex (regular expressions)
 ** Esempi:
 */
$testo = "Ciao mondo";

preg_match("#mondo#", $testo);

echo preg_match("#mondo#", $testo) ? "Pattern trovato" : "Pattern non trovato";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * ^ = ricerca all'inizio della stringa
 */
echo "Pattern: ^ciao, Subject: ciao a tutti"."<br>";
echo preg_match("#^ciao#", "ciao a tutti") ? "Pattern trovato all'inizio" : "Pattern non trovato all'inizio";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * $ = ricerca alla fine della stringa
 */
echo "Pattern: tutti#, Subject: ciao a tutti"."<br>";
echo preg_match("#tutti$#", "ciao a tutti") ? "Pattern trovato alla fine" : "Pattern non trovato alla fine";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * [numeri-numeri] = riceca numeri contenuti nel range
 ** Nota: se ad esempio [0-9], troverà qualsiasi numero con quella cifra, quindi anche 99 sarà true
 */
echo "Pattern: [0-9], Subject: ciao a 12345 tutti"."<br>";
echo preg_match("#[0-9]#", "ciao a 12345 tutti") ? "Pattern numerico trovato" : "Pattern numerico non trovato";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * [char-char char(maiusc)-char(maiusc)] = riceca caratteri sia maiusc che minusc
 */
echo "Pattern: [A-Ca-C], Subject: CIAO A tutti"."<br>";
echo preg_match("#[A-Ca-c]#", "CIAO A tutti") ? "Pattern stringa trovato" : "Pattern stringa non trovato";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * [^] = NEGATO
 ** ^ in un range [] significa negato, quindi cerca la mancanza di ciò che gli segue
 */
echo "Pattern: [^0-9], Subject: 12345"."<br>";
echo preg_match("#[^0-9]#", "12345") ? "Pattern numerico NON trovato (true)" : "Pattern numerico trovato (false)";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";

echo "Pattern: R[aeiou]vigo, Subject: Ruvigo"."<br>";
echo preg_match("#R[aeiou]vigo#", "Ruvigo") ? "Pattern trovato" : "Pattern non trovato";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * preg_match(pattern, subject, $matches)
 ** la funzione mette ciò che ha trovato nell'array $matches
 */
echo "Pattern: R[aeiou]+vigo[0-9]*, Subject: Ruvigo98"."<br>";
echo preg_match("#R[aeiou]+vigo[0-9]*#", "Ruvigo98", $matches) ? "Pattern trovato <br>" : "Pattern non trovato <br>";
var_dump($matches);

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * i alla fine del pattern rende case insensitive
 */
echo "Pattern: #ciao#i, Subject: CiAo"."<br>";
echo preg_match("#ciao#i", "CiAo") ? "Pattern trovato" : "Pattern non trovato";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";

$tel = 3396835338;
echo "Pattern: [0-9]{10}, Subject: $tel"."<br>";
echo preg_match("#[0-9]{10}#", "$tel") ? "Pattern trovato" : "Pattern non trovato";

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";

echo "Pattern: verde|rosso|giallo|blu di prussia, Subject: blu di prussia"."<br>";
echo preg_match("#verde|rosso|giallo|blu di prussia#", "blu di prussia") ? "Pattern trovato" : "Pattern non trovato";

#-----------------------------------------------------------------------------------------------------------------------
echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------