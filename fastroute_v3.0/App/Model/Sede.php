<?php
require_once __DIR__ . '/../Core/DBconn.php';

class Sede {
    private $pdo;

    public function __construct() {
        $this->pdo = DBconn::getConnection();
    }

    public function getAll() {
        return $this->pdo->query("SELECT * FROM sedi ORDER BY nome")->fetchAll();
    }
}