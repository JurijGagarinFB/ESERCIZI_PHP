<?php
require_once __DIR__ . '/../Model/Plico.php';

class DashboardController {
    public function __construct() {
        if (!utenteLoggato()) redirect('?page=login');
        if (!empty($_SESSION['utente']['primo_accesso'])) redirect('?page=cambia_password');
    }

    public function index() {
        $plicoModel = new Plico();
        $spedizioni = $plicoModel->getAll();

        $pageTitle = 'Dashboard - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/dashboard.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}