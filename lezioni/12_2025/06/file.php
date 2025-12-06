<?php

echo getcwd();
echo "<br>";
echo "separatore directory del sistema operativo in uso: " . DIRECTORY_SEPARATOR;

$path = getcwd();
echo "<br>";
echo is_file($path . DIRECTORY_SEPARATOR . "provafile.txt") ? "true" : "false";
echo "<br>";
echo is_dir($path . DIRECTORY_SEPARATOR . "provadir") ? "true" : "false";

echo "<br>";
$items = scandir($path);
echo "<h1> file nella directory: </h1>";
echo "<ul>";
foreach ($items as $item) {
    echo "<li>$item</li>";
}

echo "<br>";
echo "<br>";

#write, sovrascrive comopletamente il contenuto del file
$file = fopen("testo.txt", "w");
fwrite($file, "ciao");
fclose($file);

#append, aggiunge il contenuto al file
$file = fopen("testo.txt", "a");
fwrite($file, "ciao a tutti appeso");
fclose($file);

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------