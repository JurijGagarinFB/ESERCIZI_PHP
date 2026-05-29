<?php
require_once __DIR__ . '/../Core/DBconn.php';

class Cliente {
    private $pdo;

    public function __construct() {
        $this->pdo = DBconn::getConnection();
    }

    public function getAll() {
        return $this->pdo->query("SELECT * FROM clienti ORDER BY cognome, nome")->fetchAll();
    }

    public function insert($nome, $cognome, $indirizzo, $telefono, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO clienti(nome, cognome, indirizzo, telefono, email, punti_fedelta) VALUES (?, ?, ?, ?, ?, 0)");
        return $stmt->execute([$nome, $cognome, $indirizzo, $telefono, $email]);
    }

    public function incrementaPunti($id) {
        $stmt = $this->pdo->prepare("UPDATE clienti SET punti_fedelta = punti_fedelta + 1 WHERE id_cliente = ?");
        return $stmt->execute([$id]);
    }
}