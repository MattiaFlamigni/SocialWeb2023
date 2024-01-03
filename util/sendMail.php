<?php
require_once("../db/database.php");
require_once("../bootstrap.php");
require_once("./Mailer.php");



// Recupera i dati dalla richiesta POST
$postId = $_POST['postId'];

// Recupera l'indirizzo email del destinatario
$recipientEmail = $dbh->getMailFromUser($dbh->getUsernameByPost($postId));

// Invia la mail
try {
    $mail = new Mailer();


    $mail->sendMail("flami2002@gmail.com", $recipientEmail, "Nuovo Like", "ciao ". $dbh->getNomeByPost($postId). ", " . $_SESSION["username"]. " ti ha appena messo like ad un post!  ");

    
    echo 'Mail sent successfully';
} catch (Exception $e) {
    echo 'Mail could not be sent. Error: ', $mail->ErrorInfo;
}
