<?php
require_once __DIR__ . '/../Core/DBconn.php';

class HomeController {
    public function index() {
        $basePath = '';
        $pageTitle = 'Home - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/public/home.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }

    public function contatti() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $messaggio = trim($_POST['messaggio'] ?? '');

            if ($nome === '' || $email === '' || $messaggio === '') {
                impostaFlash('error', 'Compila tutti i campi del form.');
            } else {
                $pdo = DBconn::getConnection();
                $sql = "INSERT INTO richieste_info(nome, email, messaggio) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nome, $email, $messaggio]);
                impostaFlash('success', 'Richiesta inviata correttamente.');
                redirect('?page=contatti');
            }
        }

        $basePath = '';
        $pageTitle = 'Contatti - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/public/contatti.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}