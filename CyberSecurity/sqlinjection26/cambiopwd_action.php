<?php
require 'config.php';
require 'header.php';
$password=$_POST['password'];
$username=$_POST['username'];
$query= "UPDATE users SET password = '$password' WHERE username = '$username'";
try {
    /** @var $pdo */
    $stm = $pdo->prepare($query);
    $result = $stm->execute();
    echo "<h1>Password cambiata correttamente</h1>";
} catch (PDOException $e) {
    echo $e->getMessage();
}
require 'footer.php';

