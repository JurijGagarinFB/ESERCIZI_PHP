<?php

return [
    "dsn" => "mysql:host=192.168.60.144;dbname=francesco_bazaj_itis;charset=utf8mb4",
    "username" => "francesco_bazaj",
    "password" => "rimprovereremmo.scacchi.",
    "options" => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
];
