<?php

$num = -10;
if ($num < 0){
    //die("Non puoi usare un numero negativo");
    header("Location: lezioni/2026/03/13/errorPage.php?msg=Non puoi usare un numero negativo");
}