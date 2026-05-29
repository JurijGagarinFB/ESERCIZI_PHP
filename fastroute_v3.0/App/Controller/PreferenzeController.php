<?php
require_once __DIR__ . '/../Model/Personale.php';

class PreferenzeController {
    public function __construct() {
        if (!utenteLoggato()) redirect('?page=login');
        if (!empty($_SESSION['utente']['primo_accesso'])) redirect('?page=cambia_password');
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $colore = trim($_POST['colore_sfondo'] ?? '#f5f5f5');
            if ($colore === '') $colore = '#f5f5f5';

            $personaleModel = new Personale();
            $personaleModel->updateColoreSfondo($_SESSION['utente']['id_personale'], $colore);
            $_SESSION['utente']['colore_sfondo'] = $colore;

            impostaFlash('success', 'Tema aggiornato correttamente.');
            redirect('?page=preferenze');
        }

        $pageTitle = 'Preferenze tema - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/preferenze.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}