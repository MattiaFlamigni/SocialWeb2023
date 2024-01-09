<?php
require_once("bootstrap.php");

$templateParams = array(); // Inizializza l'array $templateParams

// Verifica se l'username è presente nei parametri di query
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Ora puoi utilizzare $username come necessario
    $templateParams["titolo"] = "Profilo";
    $templateParams["titolo_pagina"] = "";
    $templateParams["nome"] = "profile.php";

    // Passa l'username a getPostsByUser e getUserByUsername
    $templateParams["posts"] = $dbh->getPostsByUser($username);
    $templateParams["utente"] = $dbh->getUserByUsername($username);

    $templateParams["numPost"] = $dbh->getNumPosts($username);
    $templateParams["numFollowing"] = $dbh->getNumFollowing($username);
    $templateParams["numFollowers"] = $dbh->getNumFollowers($username);

    require("template/base.php");
} else {
    // Se l'username non è presente nei parametri di query, gestisci l'errore o reindirizza l'utente
    echo "Errore: Username non specificato.";
}
?>
