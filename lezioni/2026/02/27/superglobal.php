<?php
/**
 ** superglobal = array associativo globale
 *
 *
 * 1. $_SERVER contiene tutte le informazioni sul server e sulla richiesta
 * 2. $_GET contiene dati inviati tramite URL (metodo GET)
 * 3. $_POST contiene dati inviati tramite form (metodo POST)
 * 4. $_FILES contiene file caricati via form
 * 5. $_COOKIE contiene
 * 6. $_SESSION contiene
 * 7. $_ENV contiene
 * 8. $_REQUEST contiene
 * 9. $GLOBALS contiene
 */

echo $_SERVER["SERVER_NAME"] . "<br>";
echo $_SERVER["PHP_SELF"] . "<br>";
echo $_SERVER["REMOTE_ADDR"] . "<br>";
echo $_SERVER["REQUEST_METHOD"] . "<br>";
?>

