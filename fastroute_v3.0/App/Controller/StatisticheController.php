<?php
require_once __DIR__ . '/../Model/Plico.php';

class StatisticheController {
    public function __construct() {
        if (!utenteLoggato()) redirect('?page=login');
        if (!empty($_SESSION['utente']['primo_accesso'])) redirect('?page=cambia_password');
    }

    public function index() {
        $plicoModel = new Plico();

        $giorni = isset($_GET['giorni']) ? (int)$_GET['giorni'] : 7;
        if ($giorni <= 0) $giorni = 7;

        $totale = $plicoModel->countRitiratiUltimiNGiorni($giorni);
        $ritirati = $plicoModel->getRitiratiUltimiNGiorni($giorni);

        $pageTitle = 'Statistiche - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/statistiche.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}