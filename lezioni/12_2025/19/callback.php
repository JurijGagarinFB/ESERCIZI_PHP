<?php
/**
 * 1. funzione di callback:
 ** Descrizione: è una funzione che viene passata come argomento ad altre funzioni
 * che viene chiamata in un secondo momento o al verificarsi di un evento.
 */
//Esempio
function esegui($callback)
{
    $callback();
}

function saluta(){
    echo "Ciao";
}

function salutaCortese()
{
    echo "Salve";
}

esegui("saluta");
echo "<br>";
esegui("salutaCortese");

echo "<br>";
echo "<br>";

function applica($callback, $val){
    return $callback($val);
}
function doppio($x){
    return $x * 2;
}

echo applica("doppio", 5);

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * 1.1 Callback con funzioni anonime
 */
echo applica(function($x){
    $x++;
    return $x * 2;
},2);

echo "<br>";
#|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
echo "<br>";
/**
 * 1.1.1 Arrow Function - Funzioni anonime compatte
 */
$doppio2 = fn($x) => $x * 2;
echo $doppio2(6);

echo "<br>";

echo applica(fn($x) => $x * 2, 7);

#-----------------------------------------------------------------------------------------------------------------------
echo "<br>";
echo "<hr>";
echo "<br>";
#-----------------------------------------------------------------------------------------------------------------------

