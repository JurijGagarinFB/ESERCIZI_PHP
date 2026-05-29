<?php
require_once __DIR__ . '/../Model/Personale.php';

class AuthController {
    private $personaleModel;

    public function __construct() {
        $this->personaleModel = new Personale();
    }

    private function salvaUtenteInSessione($utente) {
        $_SESSION['utente'] = [
            'id_personale'   => $utente->id_personale,
            'nome'           => $utente->nome,
            'cognome'        => $utente->cognome,
            'email'          => $utente->email,
            'ruolo'          => $utente->ruolo,
            'colore_sfondo'  => $utente->colore_sfondo,
            'primo_accesso'  => $utente->primo_accesso,
            'id_sede'        => $utente->id_sede
        ];
    }

    public function login() {
        if (utenteLoggato()) {
            if (!empty($_SESSION['utente']['primo_accesso'])) {
                redirect('?page=cambia_password');
            } else {
                redirect('?page=dashboard');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($email === '' || $password === '') {
                impostaFlash('error', 'Inserisci e-mail e password.');
                redirect('?page=login');
            }

            $utente = $this->personaleModel->findByEmail($email);

            // accetta sia password in chiaro che hashate (per test)
            if ($utente && ($password === $utente->password || password_verify($password, $utente->password))) {
                $this->salvaUtenteInSessione($utente);

                if ($utente->primo_accesso == 1) {
                    impostaFlash('info', 'Al primo accesso devi cambiare password.');
                    redirect('?page=cambia_password');
                } else {
                    impostaFlash('success', 'Login effettuato correttamente.');
                    redirect('?page=dashboard');
                }
            } else {
                impostaFlash('error', 'Credenziali non valide.');
                redirect('?page=login');
            }
        }

        $basePath = '';
        $pageTitle = 'Login - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/auth/login.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        redirect('?page=login');
    }

    public function cambiaPassword() {
        if (!utenteLoggato()) {
            redirect('?page=login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuovaPassword = trim($_POST['nuova_password'] ?? '');
            $confermaPassword = trim($_POST['conferma_password'] ?? '');

            if ($nuovaPassword === '' || $confermaPassword === '') {
                impostaFlash('error', 'Compila tutti i campi.');
                redirect('?page=cambia_password');
            }

            if ($nuovaPassword !== $confermaPassword) {
                impostaFlash('error', 'Le password non coincidono.');
                redirect('?page=cambia_password');
            }

            if (!passwordValida($nuovaPassword)) {
                impostaFlash('error', 'La password non rispetta i requisiti minimi.');
                redirect('?page=cambia_password');
            }

            $hash = password_hash($nuovaPassword, PASSWORD_DEFAULT);
            $this->personaleModel->updatePassword($_SESSION['utente']['id_personale'], $hash);

            $_SESSION['utente']['primo_accesso'] = 0;

            impostaFlash('success', 'Password aggiornata correttamente.');
            redirect('?page=dashboard');
        }

        $basePath = '';
        $pageTitle = 'Cambia password - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/auth/cambia_password.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}