<?php
require_once __DIR__ . '/../Model/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct() {
        if (!utenteLoggato()) redirect('?page=login');
        if (!empty($_SESSION['utente']['primo_accesso'])) redirect('?page=cambia_password');
        $this->clienteModel = new Cliente();
    }

    public function inserisci() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $cognome = trim($_POST['cognome'] ?? '');
            $indirizzo = trim($_POST['indirizzo'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if ($nome === '' || $cognome === '' || $indirizzo === '' || $email === '') {
                impostaFlash('error', 'Compila tutti i campi obbligatori.');
                redirect('?page=clienti_inserisci');
            }

            try {
                $this->clienteModel->insert($nome, $cognome, $indirizzo, $telefono, $email);
                impostaFlash('success', 'Cliente inserito correttamente.');
            } catch (PDOException $e) {
                impostaFlash('error', 'Errore durante l\'inserimento del cliente.');
            }

            redirect('?page=clienti_inserisci');
        }

        $clienti = $this->clienteModel->getAll();
        $basePath = '';
        $pageTitle = 'Inserimento clienti - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/clienti_inserisci.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}