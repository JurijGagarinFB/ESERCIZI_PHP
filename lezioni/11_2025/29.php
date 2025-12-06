<?php
$studente = [
    "nome" => "Mario",
    "cognome" => "Rossi",
    "eta" => 25
];

foreach ($studente as $chiave => $valore){
    echo "$chiave: $valore <br>";
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

echo "Vettore associativo annidato <br>";
$studenti = [
    "studente1" => [
        "nome" => "Mario",
        "voto" => 7
    ],
    "studente2" => [
        "nome" => "Paolo",
        "voto" => 9
    ]
];

echo $studenti["studente1"]["nome"];
echo "<br>";
echo $studenti["studente2"]["voto"];

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$config = [
    "database" => "db_nome",
    "user" => "root",
    "password" => "sus"
];

if (array_key_exists("database",$config)){
    echo "chiave trovata";
} else {
    echo "chiave non trovata";
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$chiavi = array_keys($studente);
var_dump($chiavi);
echo "<br>";
$valori = array_values($studente);
var_dump($valori);

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

foreach ($studente as $chiave => $valore){
    if ($chiave == "eta"){
        echo "$valore";
    }
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

if (array_key_exists("eta",$studente)){
    echo "chiave eta esiste:";
    echo "<br>";
    echo $studente["eta"];
} else {
    echo "chiave eta non esiste";
}

echo "<br>";

echo next($studente);

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$var1 = 5;
$var2 = "5";
$var3 = "ciao";

if($var1 == $var2){
    echo "le due variabili sono uguali";
} else {
    echo "le due variabili sono diverse";
}

echo "<br>";

if($var1 === $var2){
    echo "le due variabili sono uguali";
} else {
    echo "le due variabili sono diverse";
}

echo "<br>";

if(0 == $var3){
    echo "le due variabili sono uguali";
} else {
    echo "le due variabili sono diverse";
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

if (isset($a)){ #restituisce false se la variabile non esiste o è null
    echo "la variabile $a esiste";
} else {
    echo "la variabile $a non esiste";
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$var5 = "0.0";
if (is_null($var5)){
    echo "è null";
} else {
    echo "non è null";
}

echo "<br>";

if (isset($var5)){
    echo "è settato";
} else {
    echo "non è settato";
}

echo "<br>";

if (empty($var5)){
    echo "è falsy";
} else {
    echo "non è falsy";
}

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------