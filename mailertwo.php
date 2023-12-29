<?php

use Dotenv\Dotenv;

require 'vendor/autoload.php';

// Carica variabili d'ambiente da .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Avvia la sessione
session_start();

// Include il file con il form di input
include './index.php';

// Include il file con le funzioni
include './function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $contact = $_POST['contact'];

    // Verifica se la checkbox "sendMail" è selezionata
    $sendMail = isset($_POST['sendMail']) ? $_POST['sendMail'] : false;

    // Se la checkbox è selezionata, procedi con l'invio dell'email
    if ($sendMail) {
        // Invia email al cliente
        sendEmail($email, "Email di conferma", getHtml($email, $telephone, $contact, $name, true));

        // Invia email a MAIL_FROM
        sendEmail($_ENV['MAIL_FROM'], "Email mandata da $name", getHtml($email, $telephone, $contact, $name, false));

        header('Location: grazie.php');
        exit();
    } else {
        // La checkbox non è selezionata, mostra un messaggio di errore
        echo 'Errore: Devi selezionare la checkbox per inviare l\'email.';
    }
}

?>