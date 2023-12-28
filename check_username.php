<?php
// Connessione al database e inizializzazione della classe di gestione del database ($dbh)
// ...

include "bootstrap.php";

if (isset($_POST["username"])) {
    $username = $_POST["username"];

    // Esegui la query per verificare se l'username è già presente nel database
    $stmt = $dbh-> checkUsernameAvailability($username);


    if ($stmt==0) {
        // L'username è già presente nel database
        echo '<span style="color: red;">Username già in uso.</span>';
    } else {
        // L'username è disponibile
        echo '<span style="color: green;">Username disponibile.</span>';
    }

}
?>
