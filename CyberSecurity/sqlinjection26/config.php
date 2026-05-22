<?php
$pdo = new PDO("mysql:host=192.168.60.144;dbname=francesco_bazaj_sqli", "francesco_bazaj", "rimprovereremmo.scacchi.");
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);