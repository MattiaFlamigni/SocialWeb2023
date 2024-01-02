<?php


require_once("../bootstrap.php");
require_once("./Mailer.php");

// recover-password.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    // Recupero dell'email inviata tramite il modulo
    $email = $_POST["email"];
    $username = $_POST["username"]; 

    // Verifica se l'utente esiste
    $result = $dbh->userExists($username);
    

    if ($result) {
        // Generazione di una nuova password casuale
        $newPassword = bin2hex(random_bytes(8));
        
        $dbh->resetPassword($username, $newPassword);

        // Invio dell'email con la nuova password
        $mailer = new Mailer();
        $mailer->sendMail("flami2002@gmail.com", $email, "Nuova password", "La tua nuova password è: $newPassword");

        echo "Un'email è stata inviata con la tua nuova password.";
        header("Refresh:0; url=../index.php");
    } else {
        echo "L'indirizzo email non è associato a nessun account.";

        header("Refresh:0; url=../index.php");

    }
}
?>
