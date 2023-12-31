<?php

require_once('../db/database.php');
require_once("../bootstrap.php");

require '..\PHPMailer\src/PHPMailer.php';
require '..\PHPMailer\src\Exception.php';
require '..\PHPMailer\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



    echo "Registrazione in corso...<br>";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["mail"];
    $nome = $_POST["name"];
    $cognome = $_POST["surname"];

    $result = $dbh->registraUtente($username, $password, $email, $nome, $cognome);
    if ($result === false) {
        echo '<script>alert("Utente già registrato!");</script>';
        header("Refresh:0; url=../index.php");
        echo "Verrai reindirizzato alla pagina di login tra 5 secondi. Se non vuoi attendere <a href='registrazione.html'>clicca qui</a>";
    } else {    


        /*TODO: FILE SEPARATO*/
        ini_set('SMTP','sandbox.smtp.mailtrap.io');
        ini_set('smtp_port',2525);



        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '539659f18e12f5';
        $phpmailer->Password = '3a718da697e70d';


        $phpmailer->setFrom('flami2002@gmail.com', 'Mailer');
        $phpmailer->addAddress($email);
        $phpmailer->Subject = 'Here is the subject';
        $phpmailer->Body = 'This is the HTML message body <b>in bold!</b>';
        $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$phpmailer->send()) {
            echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }

        




        /*$to = 'flami2002@gmail.com ';
        $subject = 'Test Email';
        $message = 'Hello, this is a test email.';

        mail($to, $subject, $message);*/







        //header("Refresh:0; url=../index.php");
        echo '<script>alert("Registrazione avvenuta con successo!");</script>';
    }


?>

