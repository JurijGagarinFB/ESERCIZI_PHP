<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';
$mail = new PHPMailer(true);

try {
    //configurazione smtp
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'francesco.bazaj@iisviolamarchesini.edu.it';
    $mail->Password = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('francesco.bazaj@iisviolamarchesini.edu.it');
    $mail->addAddress("diego.renesto@iisviolamarchesini.edu.it");
    $mail->Subject = '';
    $mail->Body = '';
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->send();
    echo 'Messaggio inviato';
} catch (Exception $e) {
    echo "Messaggio non inviato. Errore: {$mail->ErrorInfo}";
}