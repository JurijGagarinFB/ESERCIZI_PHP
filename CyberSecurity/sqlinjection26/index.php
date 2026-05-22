<?php
require 'header.php';
$msg= $_GET['msg'] ?? '';
echo "<h1>ciao<h1>". $msg;
require 'footer.php';

