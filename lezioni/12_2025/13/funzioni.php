<?php

function somma(int|float $a, int|float $b) : int|float {
    return $a + $b;
}

echo somma(10, 20.5);
echo "<br>";
echo "<br>";

function stampa(int|string $a) : void {
    echo "Hai passato: ".$a;
}
stampa("ciao");

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------

function saluta(?string $nome) : string {
    return "Ciao ".($nome ?? "Ospite");
}

echo saluta("Mario");
echo "<br>";
echo saluta(null);

echo "<br>";
echo "<br>";

function saluta2(string $nome = "Utente") : string {
    return "Ciao ".($nome ?? "Ospite");
}
echo saluta2();

echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------
function sommaTotale(...$numeri) : int|float{
    return array_sum($numeri);
}

echo sommaTotale(1,2,3,4,5,6,7,8,9,10);

echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------