<?php
// Variabili di test per gli esempi
$intero = -42;
$decimale = 9.876;
$stringa_num = "123.45";
$array_numeri = [5, 12, 8, 99, 1];

echo "<h1>Documentazione Funzioni Numeriche PHP</h1>";
echo "<p>Variabili di test: Intero [$intero], Decimale [$decimale], Stringa Numerica ['$stringa_num']</p>";
echo "<hr>";

#---------------------------------------------------------------------------------------

/**
 * 1. abs()
 * Descrizione: Restituisce il valore assoluto (positivo) di un numero.
 * Esempio: abs(-42) diventa 42.
 */
echo "<h3>abs</h3>";
echo "Originale: $intero <br>";
echo "Assoluto: " . abs($intero);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 2. ceil()
 * Descrizione: Arrotonda un numero decimale all'intero superiore più vicino.
 * Esempio: ceil(9.1) diventa 10.
 */
echo "<h3>ceil</h3>";
echo "Originale: $decimale <br>";
echo "Arrotondato per eccesso: " . ceil($decimale);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 3. floor()
 * Descrizione: Arrotonda un numero decimale all'intero inferiore più vicino.
 * Esempio: floor(9.9) diventa 9.
 */
echo "<h3>floor</h3>";
echo "Originale: $decimale <br>";
echo "Arrotondato per difetto: " . floor($decimale);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 4. round()
 * Descrizione: Arrotonda un numero virgola mobile (standard). Può specificare la precisione decimale.
 * Esempio: round(9.876, 1) diventa 9.9.
 */
echo "<h3>round</h3>";
echo "Arrotondamento classico (0 decimali): " . round($decimale) . "<br>";
echo "Arrotondamento a 2 decimali: " . round($decimale, 2);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 5. mt_rand()
 * Descrizione: Genera un numero intero casuale usando l'algoritmo Mersenne Twister (più veloce e sicuro di rand).
 * Esempio: mt_rand(1, 100) genera un numero tra 1 e 100.
 */
echo "<h3>mt_rand</h3>";
echo "Numero casuale (1-100): " . mt_rand(1, 100);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 6. rand()
 * Descrizione: Genera un numero intero casuale (versione classica, meno efficiente di mt_rand).
 * Esempio: rand(1, 100).
 */
echo "<h3>rand</h3>";
echo "Numero casuale (1-100): " . rand(1, 100);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 7. min()
 * Descrizione: Trova il valore più basso in un elenco di argomenti o in un array.
 * Esempio: min(1, 5, 2) restituisce 1.
 */
echo "<h3>min</h3>";
echo "Minimo nell'array [5, 12, 8, 99, 1]: " . min($array_numeri);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 8. max()
 * Descrizione: Trova il valore più alto in un elenco di argomenti o in un array.
 * Esempio: max(1, 5, 2) restituisce 5.
 */
echo "<h3>max</h3>";
echo "Massimo nell'array [5, 12, 8, 99, 1]: " . max($array_numeri);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 9. sqrt()
 * Descrizione: Calcola la radice quadrata di un numero.
 * Esempio: sqrt(16) restituisce 4.
 */
echo "<h3>sqrt</h3>";
echo "Radice quadrata di 64: " . sqrt(64);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 10. pow()
 * Descrizione: Espressione esponenziale (base elevata a potenza).
 * Esempio: pow(2, 3) equivale a 2^3 = 8.
 */
echo "<h3>pow</h3>";
echo "2 alla 3a potenza: " . pow(2, 3);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 11. intdiv()
 * Descrizione: Esegue una divisione intera (restituisce il quoziente intero scartando il resto).
 * Esempio: intdiv(10, 3) restituisce 3.
 */
echo "<h3>intdiv</h3>";
echo "10 diviso 3 (divisione intera): " . intdiv(10, 3);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 12. number_format()
 * Descrizione: Formatta un numero con le migliaia raggruppate e decimali definiti.
 * Esempio: number_format(1000.5, 2, ',', '.') restituisce "1.000,50".
 */
echo "<h3>number_format</h3>";
echo "Numero: 12345.6789 <br>";
echo "Formattato: " . number_format(12345.6789, 2, ",", ".");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 13. is_numeric()
 * Descrizione: Verifica se una variabile è un numero o una stringa numerica.
 * Esempio: is_numeric("123") restituisce TRUE.
 */
echo "<h3>is_numeric</h3>";
// Uso una operazione ternaria per stampare SI/NO invece di 1/vuoto
echo "La stringa '123.45' è numerica? " . (is_numeric($stringa_num) ? "Sì" : "No");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 14. is_int()
 * Descrizione: Verifica se il tipo di una variabile è esattamente intero (Integer).
 * Esempio: is_int(5) è TRUE, is_int("5") è FALSE.
 */
echo "<h3>is_int</h3>";
echo "Il numero 9.876 è intero? " . (is_int($decimale) ? "Sì" : "No");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 15. is_float()
 * Descrizione: Verifica se il tipo di una variabile è virgola mobile (Float/Double).
 * Esempio: is_float(5.5) è TRUE.
 */
echo "<h3>is_float</h3>";
echo "Il numero 9.876 è float? " . (is_float($decimale) ? "Sì" : "No");
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 16. intval()
 * Descrizione: Restituisce il valore intero di una variabile (tronca i decimali se presenti).
 * Esempio: intval("42.8") restituisce 42.
 */
echo "<h3>intval</h3>";
echo "Valore intero di 9.876: " . intval($decimale);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 17. floatval()
 * Descrizione: Restituisce il valore float (virgola mobile) di una variabile.
 * Esempio: floatval("123.45") restituisce 123.45 come numero.
 */
echo "<h3>floatval</h3>";
echo "Valore float della stringa '123.45': ";
var_dump(floatval($stringa_num)); // Uso var_dump per mostrare che è diventato float
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 18. pi()
 * Descrizione: Restituisce il valore approssimato di PI greco.
 * Esempio: pi().
 */
echo "<h3>pi</h3>";
echo pi();
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 19. log()
 * Descrizione: Calcola il logaritmo naturale di un numero.
 * Esempio: log(10).
 */
echo "<h3>log</h3>";
echo "Logaritmo naturale di 10: " . log(10);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 20. exp()
 * Descrizione: Calcola l'esponente di e (e elevato alla potenza di...). Inverso di log().
 * Esempio: exp(1) restituisce il valore di Eulero (circa 2.718).
 */
echo "<h3>exp</h3>";
echo "e elevato alla 1: " . exp(1);
echo "<br>";

echo "<br><hr><br>";
