<?php

require_once("db/database.php");
require_once("bootstrap.php");

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["mail"])) { //todo: aggiungere controlli

    echo "Registrazione in corso...<br>";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["mail"];
    $nome = $_POST["name"];
    $cognome = $_POST["surname"];

    $result = $dbh->registraUtente($username, $password, $email, $nome, $cognome);
    if ($result === false) {
        echo '<script>alert("Utente già registrato!");</script>';

        /*attendere 5 secondi*/
        header("Refresh:0; url=registrati.html");
        echo "Verrai reindirizzato alla pagina di registrazione tra 5 secondi. Se non vuoi attendere <a href='registrazione.html'>clicca qui</a>";
    } else {
        echo '<script>alert("Registrazione avvenuta con successo!");</script>';
    }
}else{
    echo "Errore nella registrazione";
}





?>

