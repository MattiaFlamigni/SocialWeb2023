<?php

require_once("../db/database.php");
require_once("../bootstrap.php");



    echo "Login in corso...<br>";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $dbh->login($username, $password);
    if ($result === false) {
        echo '<script>alert("Utente non registrato!");</script>';

 
        header("Refresh:0; url=../registrati.php");
        echo "Verrai reindirizzato alla pagina di registrazione tra 5 secondi. Se non vuoi attendere <a href='registrazione.html'>clicca qui</a>";
    } else {
        header("Refresh:0; url=../mainFeed.html");
        
    }


?>

