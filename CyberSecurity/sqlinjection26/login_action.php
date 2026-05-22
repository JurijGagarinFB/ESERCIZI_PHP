<?php
require 'config.php';
require 'header.php';
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE username = :username AND password = :password";

try {
    /** @var $pdo */
    $stm = $pdo->prepare($query);
    $stm->bindValue(':username', $username);
    $stm->bindValue(':password', $password);
    $stm->execute();
    $user = $stm->fetch();
    $_SESSION['username'] = $user->username;
    $msg= htmlspecialchars("Ciao ".$user->username." login effettuato. Il tuo ruolo è ".$user->role);
    header('Location: index.php?msg='.$msg);
} catch (PDOException $e) {
    echo $e->getMessage();
}
