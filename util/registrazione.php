<?php

require_once('../db/database.php');
require_once("../bootstrap.php");



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
        echo "Verrai reindirizzato alla pagina di registrazione tra 5 secondi. Se non vuoi attendere <a href='registrazione.html'>clicca qui</a>";
    } else {
        header("Refresh:0; url=../index.php");
        echo '<script>alert("Registrazione avvenuta con successo!");</script>';
    }


?>

