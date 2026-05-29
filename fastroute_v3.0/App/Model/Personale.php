<?php
require_once __DIR__ . '/../Core/DBconn.php';

class Personale {
    private $pdo;

    public function __construct() {
        $this->pdo = DBconn::getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM personale WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function updatePassword($id, $hash) {
        $stmt = $this->pdo->prepare("UPDATE personale SET password = ?, primo_accesso = 0 WHERE id_personale = ?");
        return $stmt->execute([$hash, $id]);
    }

    public function updateColoreSfondo($id, $colore) {
        $stmt = $this->pdo->prepare("UPDATE personale SET colore_sfondo = ? WHERE id_personale = ?");
        return $stmt->execute([$colore, $id]);
    }
}