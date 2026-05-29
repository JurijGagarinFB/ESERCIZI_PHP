<?php
require_once __DIR__ . '/../Core/DBconn.php';

class Destinatario {
    private $pdo;

    public function __construct() {
        $this->pdo = DBconn::getConnection();
    }

    public function insert($nome, $cognome, $indirizzo, $telefono, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO destinatari(nome, cognome, indirizzo, telefono, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $cognome, $indirizzo, $telefono, $email]);
        return $this->pdo->lastInsertId();
    }
}