<?php
require_once __DIR__ . '/../Core/DBconn.php';

class Plico {
    private $pdo;

    public function __construct() {
        $this->pdo = DBconn::getConnection();
    }

    public function insert($codice, $idCliente, $idDestinatario, $idPartenza, $idArrivo) {
        $stmt = $this->pdo->prepare("INSERT INTO plichi(codice_plico, data_ora_accettazione, data_ora_spedizione, data_ora_ritiro, stato, id_cliente, id_destinatario, id_sede_partenza, id_sede_arrivo) VALUES (?, NOW(), NULL, NULL, 'in partenza', ?, ?, ?, ?)");
        return $stmt->execute([$codice, $idCliente, $idDestinatario, $idPartenza, $idArrivo]);
    }

    public function findByCodice($codice) {
        $stmt = $this->pdo->prepare("
            SELECT p.*, c.email as email_mittente, c.nome as nome_cliente, c.cognome as cognome_cliente,
                   d.nome as nome_destinatario, d.cognome as cognome_destinatario,
                   sp.nome as sede_partenza, sa.nome as sede_arrivo
            FROM plichi p
            JOIN clienti c ON p.id_cliente = c.id_cliente
            JOIN destinatari d ON p.id_destinatario = d.id_destinatario
            JOIN sedi sp ON p.id_sede_partenza = sp.id_sede
            JOIN sedi sa ON p.id_sede_arrivo = sa.id_sede
            WHERE p.codice_plico = ?
        ");
        $stmt->execute([$codice]);
        return $stmt->fetch();
    }

    public function getAll() {
        return $this->pdo->query("
            SELECT p.*, c.nome as nome_cliente, c.cognome as cognome_cliente,
                   d.nome as nome_destinatario, d.cognome as cognome_destinatario,
                   sp.nome as sede_partenza, sa.nome as sede_arrivo
            FROM plichi p
            JOIN clienti c ON p.id_cliente = c.id_cliente
            JOIN destinatari d ON p.id_destinatario = d.id_destinatario
            JOIN sedi sp ON p.id_sede_partenza = sp.id_sede
            JOIN sedi sa ON p.id_sede_arrivo = sa.id_sede
            ORDER BY p.data_ora_accettazione DESC
        ")->fetchAll();
    }

    public function getByStato($stato) {
        $stmt = $this->pdo->prepare("SELECT * FROM plichi WHERE stato = ? ORDER BY data_ora_accettazione DESC");
        $stmt->execute([$stato]);
        return $stmt->fetchAll();
    }

    public function spedisci($codice) {
        $stmt = $this->pdo->prepare("UPDATE plichi SET data_ora_spedizione = NOW(), stato = 'in transito' WHERE codice_plico = ? AND data_ora_spedizione IS NULL");
        $stmt->execute([$codice]);
        return $stmt->rowCount();
    }

    public function ritira($codice) {
        $stmt = $this->pdo->prepare("UPDATE plichi SET data_ora_ritiro = NOW(), stato = 'ritirato' WHERE codice_plico = ?");
        return $stmt->execute([$codice]);
    }

    public function countRitiratiUltimiNGiorni($giorni) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as totale FROM plichi WHERE stato = 'ritirato' AND data_ora_ritiro >= DATE_SUB(NOW(), INTERVAL ? DAY)");
        $stmt->execute([$giorni]);
        return $stmt->fetch()->totale;
    }

    public function getRitiratiUltimiNGiorni($giorni) {
        $stmt = $this->pdo->prepare("SELECT codice_plico, data_ora_ritiro FROM plichi WHERE stato = 'ritirato' AND data_ora_ritiro >= DATE_SUB(NOW(), INTERVAL ? DAY) ORDER BY data_ora_ritiro DESC");
        $stmt->execute([$giorni]);
        return $stmt->fetchAll();
    }
}