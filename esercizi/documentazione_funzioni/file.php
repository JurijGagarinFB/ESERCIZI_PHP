<?php
$file_path = "test_file.txt";
$contenuto_iniziale = "Riga 1: Ciao\nRiga 2: Mondo\nRiga 3: PHP";

echo "<h1>Documentazione Funzioni File System</h1>";
echo "<p>File utilizzato per i test: $file_path</p>";
echo "<hr>";

#---------------------------------------------------------------------------------------

/**
 * 1. fopen()
 * Descrizione: Apre un file o un URL e restituisce un puntatore al file.
 * Esempio: $handle = fopen("file.txt", "w"); (Modalità: 'w' scrittura, 'r' lettura, 'a' append).
 */
echo "<h3>fopen</h3>";
// Apro il file in modalità scrittura ('w'). Se non esiste, lo crea.
$handle = fopen($file_path, "w");
echo "File " . $file_path . " aperto in modalità scrittura";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 2. fwrite()
 * Descrizione: Scrive una stringa all'interno di un file aperto tramite fopen().
 * Esempio: fwrite($handle, "Testo da scrivere");
 */
echo "<h3>fwrite</h3>";
$bytes = fwrite($handle, $contenuto_iniziale);
echo "Scritti $bytes bytes nel file.";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 3. fclose()
 * Descrizione: Chiude un puntatore a un file aperto, rilasciando le risorse.
 * Esempio: fclose($handle);
 */
echo "<h3>fclose</h3>";
fclose($handle);
echo "File " . $file_path . " chiuso correttamente.";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 4. file_put_contents()
 * Descrizione: Scrive una stringa su un file. Equivale a fare fopen(), fwrite() e fclose() in sequenza.
 * Esempio: file_put_contents("file.txt", "Nuovo contenuto");
 */
echo "<h3>file_put_contents</h3>";
// Sovrascrivo il file con un nuovo contenuto più semplice per i prossimi test
$nuovo_testo = "Mela,Pera,Banana,Kiwi";
file_put_contents($file_path, $nuovo_testo);
echo "File " . $file_path . " sovrascritto con: '$nuovo_testo'";
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 5. file_get_contents()
 * Descrizione: Legge un intero file e lo restituisce come stringa.
 * Esempio: $testo = file_get_contents("file.txt");
 */
echo "<h3>file_get_contents</h3>";
$contenuto_letto = file_get_contents($file_path);
echo "Contenuto letto: " . $contenuto_letto;
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 6. explode()
 * Descrizione: Divide una stringa in un array.
 * Esempio: explode(",", "a,b,c");
 */
echo "<h3>explode</h3>";
$array_frutta = explode(",", $contenuto_letto);
print_r($array_frutta);
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 7. implode()
 * Descrizione: Unisce gli elementi di un array in una stringa.
 * Esempio: implode(" - ", $array);
 */
echo "<h3>implode</h3>";
$stringa_da_array = implode(" - ", $array_frutta);
echo "Array riconvertito in stringa: " . $stringa_da_array;
echo "<br>";

#---------------------------------------------------------------------------------------

/**
 * 8. fgets()
 * Descrizione: Legge una singola riga da un puntatore a un file aperto.
 * Esempio: $riga = fgets($handle);
 */
echo "<h3>fgets</h3>";

// Per usare fgets dobbiamo riaprire il file, questa volta in lettura ('r')
// Prima ricreo un file a più righe per rendere l'esempio chiaro
$testo_multiriga = "Riga Uno\nRiga Due\nRiga Tre";
file_put_contents($file_path, $testo_multiriga);

$handle_lettura = fopen($file_path, "r");

echo "Lettura riga per riga:<br>";
// Leggiamo la prima riga
echo "1: " . fgets($handle_lettura) . "<br>";
// Leggiamo la seconda riga (il puntatore avanza da solo)
echo "2: " . fgets($handle_lettura) . "<br>";

fclose($handle_lettura);
echo "<br>";

echo "<hr><br>";