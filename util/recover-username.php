<?php

require_once("../bootstrap.php");
require_once("./Mailer.php");

$mail = $_POST["mail"];
$password = $_POST["password"];

$result = $dbh->recoverUser($mail, $password);

if($result==true){
    $mailer = new Mailer();
    $mailer->sendMail("flami2002@gmail.com", $mail, "Recupero username", "Il tuo username è:" .  $result);
    echo '<script>alert("Email inviata con successo!");</script>';
    header("Refresh:0; url=../index.php");
}else{
    echo '<script>alert("Utente non trovato!");</script>';
    header("Refresh:0; url=../index.php");
}





?>