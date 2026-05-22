<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="mystyle.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<a href="index.php">Index</a>
<a href="tablet.php">Tablet</a>
<?php if (!isset($_SESSION['username'])) { ?>
<a href="login.php">Login</a>
<?php }?>
<?php if (isset($_SESSION['username'])) { ?>
    <a href="changepwd.php">Cambia pwd</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
    <span><?=$_SESSION['username']?></span>
<?php }?>
<br>
<br>
