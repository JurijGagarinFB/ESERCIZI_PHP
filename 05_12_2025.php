<?php
$numeri = [10, 20, 1, 3];
$risultato = array_map(function($n){
    return $n * 2;
}, $numeri);

var_dump($risultato);

echo "<br>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$risultato2 = array_filter($numeri, function($n){
    return $n % 2 == 0;
});

var_dump($risultato2);

echo "<br>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

array_walk($numeri, function(&$n){
    $n = $n + 10;
});

var_dump($numeri);

echo "<br>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$risultato_lambda = array_map(fn($n) => $n + 10, $numeri);
    $n = $n + 10;
});

var_dump($numeri);

echo "<br>";
echo "<br>";