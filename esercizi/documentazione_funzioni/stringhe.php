<?php

$stringa = "ciao e buongiorno  ";
$numero = 1234.567; // Per number_format
$stringa_con_quote = "L'albero è alto"; // Per addslashes

echo "<h1>Documentazione Funzioni Stringhe PHP</h1>";
echo "<p>Stringa di base utilizzata: [" . $stringa . "]</p>";
echo "<hr>";

#---------------------------------------------------------------------------------------

/**
 * 1. strlen()
 * Descrizione: Calcola la lunghezza di una stringa.
 * Esempio: strlen("ciao") restituisce 4.
 */
echo "<h3>strlen</h3>";
echo "Lunghezza (compresi spazi): " . strlen($stringa);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 2. strrev()
 * Descrizione: Inverte una stringa.
 * Esempio: strrev("ciao") restituisce "oaic".
 */
echo "<h3>strrev</h3>";
echo strrev($stringa);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 3. ucfirst()
 * Descrizione: Converte in maiuscolo solo il primo carattere della stringa.
 * Esempio: ucfirst("ciao mondo") restituisce "Ciao mondo".
 * Nota: Uso trim() qui per togliere lo spazio iniziale, altrimenti non si vedrebbe l'effetto.
 */
echo "<h3>ucfirst</h3>";
echo ucfirst(trim($stringa));
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 4. ucwords()
 * Descrizione: Converte in maiuscolo il primo carattere di ogni parola.
 * Esempio: ucwords("mario rossi") restituisce "Mario Rossi".
 */
echo "<h3>ucwords</h3>";
echo ucwords($stringa);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 5. strtolower()
 * Descrizione: Converte tutta la stringa in minuscolo.
 * Esempio: strtolower("CIAO") restituisce "ciao".
 */
echo "<h3>strtolower</h3>";
echo strtolower($stringa);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 6. strtoupper()
 * Descrizione: Converte tutta la stringa in maiuscolo.
 * Esempio: strtoupper("ciao") restituisce "CIAO".
 */
echo "<h3>strtoupper</h3>";
echo strtoupper($stringa);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 7. trim()
 * Descrizione: Rimuove spazi (o altri caratteri) dall'inizio e alla fine della stringa.
 * Esempio: trim(" a ") restituisce "a".
 */
echo "<h3>trim</h3>";
echo "Originale: [" . $stringa . "] <br>";
echo "Trimmed: [" . trim($stringa) . "]";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 8. ltrim()
 * Descrizione: Left Trim - Rimuove spazi solo dall'inizio (sinistra).
 */
echo "<h3>ltrim</h3>";
echo "[" . ltrim($stringa) . "]";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 9. rtrim()
 * Descrizione: Right Trim - Rimuove spazi solo alla fine (destra).
 */
echo "<h3>rtrim</h3>";
echo "[" . rtrim($stringa) . "]";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 10. explode()
 * Descrizione: Divide una stringa in un array basandosi su un separatore.
 * Nota: Richiede il separatore come primo argomento.
 * Esempio: explode(" ", "a b c") crea array("a", "b", "c").
 */
echo "<h3>explode</h3>";
$array_parole = explode(" ", trim($stringa));
print_r($array_parole);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 11. implode()
 * Descrizione: Unisce gli elementi di un array in una stringa.
 * Nota: Richiede un array come input, non una stringa.
 * Esempio: implode("-", array("a","b")) restituisce "a-b".
 */
echo "<h3>implode</h3>";
// Riunisco l'array creato sopra con un trattino
echo implode("-", $array_parole);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 12. str_replace()
 * Descrizione: Sostituisce tutte le occorrenze di una stringa di ricerca con una di sostituzione.
 * Nota: Richiede (CosaCercare, ConCosaSostituire, DoveCercare).
 * Esempio: str_replace("a", "b", "mama") restituisce "mbmb".
 */
echo "<h3>str_replace</h3>";
echo str_replace("ciao", "salve", $stringa);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 13. substr()
 * Descrizione: Restituisce una porzione della stringa.
 * Nota: Richiede (Stringa, Inizio, [Lunghezza]).
 * Esempio: substr("abcdef", 0, 3) restituisce "abc".
 */
echo "<h3>substr</h3>";
// Prende dal carattere 2 (terza lettera) per 4 caratteri
echo substr(trim($stringa), 2, 4);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 14. strpos()
 * Descrizione: Trova la posizione numerica della PRIMA occorrenza di una sottostringa.
 * Nota: Richiede (DoveCercare, CosaCercare), è case sensitive.
 * Esempio: strpos("banane", "n") restituisce 2.
 */
echo "<h3>strpos</h3>";
echo "Posizione di 'buongiorno': " . strpos($stringa, "buongiorno");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 15. strrpos()
 * Descrizione: Trova la posizione numerica dell'ULTIMA occorrenza di una sottostringa.
 * Esempio: strrpos("banane", "a") restituisce 3 (la seconda 'a').
 */
echo "<h3>strrpos</h3>";
echo "Ultima 'o' si trova all'indice: " . strrpos($stringa, "o");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 16. strstr()
 * Descrizione: Trova la prima occorrenza di una stringa e restituisce il resto della stringa da quel punto.
 */
echo "<h3>strstr</h3>";
echo strstr($stringa, "e"); // Restituisce da "e" in poi
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 17. stristr()
 * Descrizione: Come strstr, ma Case-Insensitive (ignora maiuscole/minuscole).
 */
echo "<h3>stristr</h3>";
echo stristr($stringa, "BUONGIORNO"); // Funziona anche se scrivo maiuscolo
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 18. sprintf()
 * Descrizione: Restituisce una stringa formattata (non la stampa direttamente).
 * Esempio: sprintf("Ciao %s", "Mario") restituisce "Ciao Mario".
 */
echo "<h3>sprintf</h3>";
$saluto = sprintf("Il messaggio è: %s", trim($stringa));
echo $saluto;
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 19. printf()
 * Descrizione: Esegue sprintf E stampa direttamente il risultato.
 */
echo "<h3>printf</h3>";
printf("La stringa ha %d caratteri.", strlen($stringa));
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 20. number_format()
 * Descrizione: Formatta un numero con raggruppamento delle migliaia.
 * Nota: Applicato alla variabile $numero, non a $stringa.
 * Parametri: (Numero, Decimali, SeparatoreDecimale, SeparatoreMigliaia).
 */
echo "<h3>number_format</h3>";
echo "Numero grezzo: $numero <br>";
echo "Formattato: " . number_format($numero, 2, ",", ".");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 21. addslashes()
 * Descrizione: Aggiunge backslash (\) davanti ai caratteri che devono essere escapati (quote, doppi apici).
 * Nota: Uso $stringa_con_quote per mostrare l'effetto.
 */
echo "<h3>addslashes</h3>";
echo "Originale: $stringa_con_quote <br>";
echo "Escapata: " . addslashes($stringa_con_quote);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 22. stripslashes()
 * Descrizione: Rimuove i backslash aggiunti da addslashes.
 */
echo "<h3>stripslashes</h3>";
$escapata = addslashes($stringa_con_quote);
echo stripslashes($escapata);
echo "<br>";

echo "<br><hr><br>";
