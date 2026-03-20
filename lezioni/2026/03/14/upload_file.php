<?php
$allowed = ["jpg", "png", "pdf"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_FILES["documento"]["error"] === UPLOAD_ERR_OK) {
        $tmp_path = $_FILES["documento"]["tmp_name"];
        // echo $tmp_path."<br>";
        $original_name = basename($_FILES["documento"]["name"]);
        // echo $original_name."<br>";
        $username = $_POST["nome"];
        // echo $username."<br>";

        //extension check
        $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            http_response_code(415);
            $msg = "estensione non consentita";
            include "message.php";
            exit();
        }

        //size check
        $maxSize = 2 * 1024 * 1024; //1024*1024 = 1MB
        $size = $_FILES["documento"]["size"];
        if ($size > $maxSize) {
            http_response_code(413);
            $msg = "file troppo grande";
            include "message.php";
            exit();
        }

        $userDir = "uploads/" . $username;
        if (!is_dir($userDir)) {
            mkdir($userDir, 0755);
        }
        $destination = $userDir . "/" . $original_name;
        move_uploaded_file($tmp_path, $destination);
        http_response_code(200);
        $msg = "File caricato con successo";
        include "message.php";
        exit();
    } else {
        http_response_code(500);
        $msg = "errore durante il caricamento del file";
        include "message.php";
        exit();
    }
} else {
    http_response_code(405);
    $msg = "metodo non consentito";
    include "message.php";
    exit();
}