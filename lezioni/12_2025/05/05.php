<?php

echo "Operatore ternario";
echo "<br>";

$x = 5;
$risultato = $x > 10 ? "Maggiore di 10" : "Minore di 10";

echo $risultato;

echo "<br>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

echo "Operatore coalescing";
echo "<br>";

$nome = null;
$risultato2 = $nome ?? "Non definito";

echo $risultato2;

echo "<br>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

echo "Operatore spaceship";
echo "<br>";

$a = 1;
$b = 2;
echo $a <=> $b;
echo "<br>";
echo $b <=> $a;

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$numeri = [10, 20, 1, 3];
$risultato = array_map(function($n){
    return $n * 2;
}, $numeri);

var_dump($risultato);

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$risultato2 = array_filter($numeri, function($n){
    return $n % 2 == 0;
});

var_dump($risultato2);

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

array_walk($numeri, function(&$n){
    $n = $n + 10;
});

var_dump($numeri);

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$risultato_lambda = array_map(fn($n) => $n + 10, $numeri);
    $n = $n + 10;
});

var_dump($numeri);

echo "<br>";
echo "<br>";