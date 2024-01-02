<?php

require_once("..\bootstrap.php");
require_once("./Mailer.php");

$mail = $_POST["mail"];
$password = $_POST["password"];

$result = $dbh->recoverUser($mail, $password);

if($result==true){
    $mailer = new Mailer();
    $mailer->sendMail("flami2002@gmail.com", $mail, "Recupero username", "Il tuo username è:" .  $result);
}else{
    '<script>alert("Utente non trovato!");</script>';
}





?>