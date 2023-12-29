<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

// Carica variabili d'ambiente da .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Avvia la sessione
session_start();

// Include il file con il form di input
include './index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $contact = $_POST['contact'];

    // Verifica se la checkbox "sendMail" è selezionata
    $sendMail = isset($_POST['sendMail']) ? $_POST['sendMail'] : false;


    // Se la checkbox è selezionata, procedi con l'invio dell'email
    if ($sendMail) {
        // Crea un'istanza di PHPMailer
        $mailToAdmin = new PHPMailer(true);


        try {
            
            // $mailToAdmin->SMTPDebug = SMTP::DEBUG_SERVER;

            $mailToAdmin->isSMTP();
            $mailToAdmin->SMTPAuth   = true;

            $mailToAdmin->Host = $_ENV['MAIL_HOST'];
            $mailToAdmin->Username = $_ENV['MAIL_USERNAME'];
            $mailToAdmin->Password = $_ENV['MAIL_PASSWORD'];
            $mailToAdmin->SMTPSecure = $_ENV['MAIL_SMTP_SECURE'];
            $mailToAdmin->Port = $_ENV['MAIL_PORT'];

            // Destinatari
            $mailToAdmin->setFrom($_ENV['MAIL_FROM']);
            $mailToAdmin->addAddress($_ENV['MAIL_FROM']);
           

            //Content
            $mailToAdmin->isHTML(true);   //Set email format to HTML
            $mailToAdmin->Subject = "Email mandata da $name";
            $mailToAdmin->Body    =  <<<END

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
            <h1>Mail del cliente</h1>
                <p>Email: $email; </p>
                <p>Telefono: $telephone; </p>
                <p>Il cliente vorrebbe essere contattato attraverso: $contact;</p>
            </body>

            END;
        

            $mailToAdmin->send();

            header('Location: grazie.php'); 
            exit();

        } catch (Exception $e) {
            echo "Impossibile inviare il messaggio. Errore Mailer: {$mailToAdmin->ErrorInfo}";
        }
    } else {
        // La checkbox non è selezionata, mostra un messaggio di errore
        echo 'Errore: Devi selezionare la checkbox per inviare l\'email.';
    } 
    
}