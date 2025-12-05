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
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

$stringa = "ciao e buongiorno";
echo strlen($stringa);
echo "<br>";
echo strrev($stringa);
echo "<br>";
echo ucfirst($stringa);
echo "<br>";
echo ucwords($stringa);
echo "<br>";

echo "<br>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------