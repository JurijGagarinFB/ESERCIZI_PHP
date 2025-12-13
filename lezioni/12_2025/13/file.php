<?php
$classe = [
    "studente1" => ["nome1", "cognome1", 8],
    "studente2" => ["nome2", "cognome2", 7],
    "studente3" => ["nome3", "cognome3", 1],
    "studente4" => ["nome4", "cognome4", 2],
    "studente5" => ["nome5", "cognome5", 9],
    "studente6" => ["nome6", "cognome6", 6]
];

$file = fopen("voti.txt", "w");
foreach ($classe as $key=>$stud) {
    $line = $key."--".implode("--", $stud).PHP_EOL;
    fwrite($file, $line);
}
fclose($file);

echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------

$datiFromFile = [];
$file = fopen("voti.txt", "r");
while (($line = fgets($file)) !== false){
    $datiFromFile[] = trim($line);
}
fclose($file);
foreach ($datiFromFile as $dati) {
    echo $dati."<br>";
}

$studente = explode("--", $datiFromFile[1]);
foreach ($studente as $st) {
    echo $st."<br>";
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------