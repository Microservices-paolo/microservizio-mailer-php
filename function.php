<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_SMTP_SECURE'];
        $mail->Port = $_ENV['MAIL_PORT'];

        $mail->setFrom($_ENV['MAIL_FROM']);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Impossibile inviare il messaggio. Errore Mailer: {$mail->ErrorInfo}";
    }
}

function getHtml($email, $telephone, $contact, $name, $isClient){
    $content =  $isClient ? getMailBodyClient($name) : getMailBody($email, $telephone, $contact);
    return <<<END
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            $content
        </body>
        </html>
    END;
}

function getMailBody($email, $telephone, $contact) {
    return <<<END

        <h1>Mail del cliente</h1>
        <p>Email: $email; </p>
        <p>Telefono: $telephone; </p>
        <p>Il cliente vorrebbe essere contattato attraverso: $contact;</p>
        
    END;
}

function getMailBodyClient($name) {
    return <<<END
       
        <h1>Ciao $name</h1>
        
        <p>Abbiamo ricevuto la tua richiesta verrai contattato a breve!</p>
      
    END;
}