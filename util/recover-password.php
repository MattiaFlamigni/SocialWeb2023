<?php


require_once("../bootstrap.php");
require_once("./Mailer.php");

// recover-password.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    // Recupero dell'email inviata tramite il modulo
    $email = $_POST["mail"];
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

        echo '<script>alert("Email inviata con successo!");</script>'
        header("Refresh:0; url=../index.php");
    } else {
        echo '<script>alert("Utente non trovato!");</script>'

        header("Refresh:0; url=../index.php");

    }
}
?>
