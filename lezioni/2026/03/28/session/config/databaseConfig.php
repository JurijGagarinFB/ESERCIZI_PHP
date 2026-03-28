<?php   //parametri di configurazione per la connessione al database creato con DBeaver
return [
    'dns' => 'mysql:host=192.168.60.144;dbname=francesco_bazaj_sessioni',   //Data Source Name
    'username' => 'francesco_bazaj',
    'password' => 'rimprovereremmo.scacchi.',
    'options' => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
];
