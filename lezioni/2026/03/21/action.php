<?php
if (isset($_POST["nome"])) {
    setcookie(
            "user", /*nome del cookie*/
            $_POST("nome"), /* valore del cookie */
            [
                    "expires" => time() + 36000,
                    "path" => "/",
                    "secure" => false, /* trasmetto anche se è http, con true solo https */
                    "httponly" => true, /*cookie leggibili solo da http, se false leggibili anche da javascript*/
                    "samesite" => "Lax"
            ]
    );
    $user = $_POST["nome"];
} else {
    $user = $_COOKIE["user"];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<p>Questa è la pagina action</p>

<p>Ciao <?=$user?></p>

<a href="show.php">Vai a show</a>
</body>
</html>
