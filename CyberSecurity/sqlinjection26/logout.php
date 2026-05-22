<?php
require 'header.php';
$_SESSION = [];
session_destroy();
header('Location:index.php?msg=logged out');
require 'footer.php';
