<?php
require_once("bootstrap.php");


$templateParams["titolo"] = "Profilo";
$templateParams["titolo_pagina"] = "Profilo";
$templateParams["nome"] = "myProfile.php";

$templateParams["posts"] = $dbh->getPostsByUser($_SESSION["username"]);
$templateParams["utente"] = $dbh->getUserByUsername($_SESSION["username"]);

$templateParams["numPost"] = $dbh->getNumPosts($_SESSION["username"]);
$templateParams["numFollowing"] = $dbh->getNumFollowing($_SESSION["username"]);
$templateParams["numFollowers"] = $dbh->getNumFollowers($_SESSION["username"]);

require("template/base.php");

?>