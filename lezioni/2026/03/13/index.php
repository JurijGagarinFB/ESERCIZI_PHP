<?php

$num = -10;
if ($num < 0){
    //die("Non puoi usare un numero negativo");
    //header("Location: errorPage.php?msg=Non puoi usare un numero negativo");
    $message = "Non puoi usare un numero negativo";
    http_response_code(413);
    include "errorPage.php";
}
