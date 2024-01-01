<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Visualizza utenti";
$templateParams["titolo_pagina"] = "Visualizza utenti";
$templateParams["nome"] = "showProfile.php";


$templateParams["following"] = $dbh->getFollowing($_SESSION["username"]);
$templateParams["followers"] = $dbh->getFollowers();

require("template/base.php");

?>