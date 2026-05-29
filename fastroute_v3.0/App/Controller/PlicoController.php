<?php
require_once __DIR__ . '/../Model/Plico.php';
require_once __DIR__ . '/../Model/Cliente.php';
require_once __DIR__ . '/../Model/Destinatario.php';
require_once __DIR__ . '/../Model/Sede.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PlicoController {
    private $plicoModel;
    private $clienteModel;
    private $destinatarioModel;
    private $sedeModel;
    private $appConfig;

    public function __construct() {
        if (!utenteLoggato()) redirect('?page=login');
        if (!empty($_SESSION['utente']['primo_accesso'])) redirect('?page=cambia_password');

        $this->plicoModel = new Plico();
        $this->clienteModel = new Cliente();
        $this->destinatarioModel = new Destinatario();
        $this->sedeModel = new Sede();
        $this->appConfig = require __DIR__ . '/../../Config/appConfig.php';
    }

    private function inviaConfermaRitiro($emailMittente, $codicePlico) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $this->appConfig['smtp']['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->appConfig['smtp']['username'];
            $mail->Password = $this->appConfig['smtp']['password'];
            $mail->SMTPSecure = $this->appConfig['smtp']['encryption'];
            $mail->Port = $this->appConfig['smtp']['port'];

            $mail->setFrom($this->appConfig['smtp']['username'], 'FastRoute');
            $mail->addAddress($emailMittente);
            $mail->Subject = "Conferma ritiro plico #" . $codicePlico;
            $mail->Body = "Gentile cliente,\n\nIl plico con codice {$codicePlico} è stato ritirato correttamente.\n\nGrazie per aver utilizzato FastRoute.";
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function accettazione() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codicePlico = (int)($_POST['codice_plico'] ?? 0);
            $idCliente = (int)($_POST['id_cliente'] ?? 0);
            $nomeDest = trim($_POST['nome_destinatario'] ?? '');
            $cognomeDest = trim($_POST['cognome_destinatario'] ?? '');
            $indirizzoDest = trim($_POST['indirizzo_destinatario'] ?? '');
            $telefonoDest = trim($_POST['telefono_destinatario'] ?? '');
            $emailDest = trim($_POST['email_destinatario'] ?? '');
            $idSedePartenza = (int)($_POST['id_sede_partenza'] ?? 0);
            $idSedeArrivo = (int)($_POST['id_sede_arrivo'] ?? 0);

            if ($codicePlico <= 0 || $idCliente <= 0 || $nomeDest === '' || $cognomeDest === '' || $indirizzoDest === '' || $idSedePartenza <= 0 || $idSedeArrivo <= 0) {
                impostaFlash('error', 'Compila tutti i campi obbligatori.');
                redirect('?page=plico_accettazione');
            }

            try {
                $pdo = DBconn::getConnection();
                $pdo->beginTransaction();

                $idDestinatario = $this->destinatarioModel->insert($nomeDest, $cognomeDest, $indirizzoDest, $telefonoDest, $emailDest);
                $this->plicoModel->insert($codicePlico, $idCliente, $idDestinatario, $idSedePartenza, $idSedeArrivo);
                $this->clienteModel->incrementaPunti($idCliente);

                $pdo->commit();
                impostaFlash('success', 'Plico accettato correttamente.');
            } catch (PDOException $e) {
                if (isset($pdo)) $pdo->rollBack();
                impostaFlash('error', 'Errore durante l\'accettazione del plico.');
            }

            redirect('?page=plico_accettazione');
        }

        // QUESTE DUE RIGHE SONO FONDAMENTALI:
        $clienti = $this->clienteModel->getAll();
        $sedi = $this->sedeModel->getAll();

        $basePath = '';
        $pageTitle = 'Accettazione plico - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/plico_accettazione.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }

    public function spedizione() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codicePlico = (int)($_POST['codice_plico'] ?? 0);

            if ($codicePlico <= 0) {
                impostaFlash('error', 'Inserisci un codice plico valido.');
                redirect('?page=plico_spedizione');
            }

            if ($this->plicoModel->spedisci($codicePlico) > 0) {
                impostaFlash('success', 'Spedizione registrata correttamente.');
            } else {
                impostaFlash('error', 'Plico non trovato oppure già spedito.');
            }

            redirect('?page=plico_spedizione');
        }

        $inPartenza = $this->plicoModel->getByStato('in partenza');
        $pageTitle = 'Spedizione plico - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/plico_spedizione.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }

    public function ritiro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codicePlico = (int)($_POST['codice_plico'] ?? 0);

            if ($codicePlico <= 0) {
                impostaFlash('error', 'Inserisci un codice plico valido.');
                redirect('?page=plico_ritiro');
            }

            $record = $this->plicoModel->findByCodice($codicePlico);

            if (!$record) {
                impostaFlash('error', 'Plico non trovato.');
                redirect('?page=plico_ritiro');
            }

            if ($record->stato === 'ritirato') {
                impostaFlash('error', 'Il plico risulta già ritirato.');
                redirect('?page=plico_ritiro');
            }

            $this->plicoModel->ritira($codicePlico);

            $mailInviata = false;
            if (!empty($record->email_mittente)) {
                $mailInviata = $this->inviaConfermaRitiro($record->email_mittente, $codicePlico);
            }

            if ($mailInviata) {
                impostaFlash('success', 'Ritiro registrato e mail inviata al mittente.');
            } else {
                impostaFlash('info', 'Ritiro registrato. Verifica configurazione email.');
            }

            redirect('?page=plico_ritiro');
        }

        $inTransito = $this->plicoModel->getByStato('in transito');
        $pageTitle = 'Ritiro plico - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/plico_ritiro.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }

    public function stato() {
        $risultato = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codicePlico = (int)($_POST['codice_plico'] ?? 0);

            if ($codicePlico > 0) {
                $risultato = $this->plicoModel->findByCodice($codicePlico);

                if (!$risultato) {
                    impostaFlash('error', 'Plico non trovato.');
                    redirect('?page=stato_plico');
                }
            }
        }

        $pageTitle = 'Stato plico - FastRoute';
        require_once __DIR__ . '/../Views/Layouts/header.php';
        require_once __DIR__ . '/../Views/Pages/backoffice/stato_plico.php';
        require_once __DIR__ . '/../Views/Layouts/footer.php';
    }
}