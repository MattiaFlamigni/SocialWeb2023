<?php
require_once("bootstrap.php");
session_start();

$templateParams["titolo"] = "Profilo";
$templateParams["titolo_pagina"] = "Profilo";
$templateParams["nome"] = "myProfile.php";

$templateParams["posts"] = $dbh->getPostsByUser($_SESSION["username"]);
$templateParams["utente"] = $dbh->getUserByUsername($_SESSION["username"]);

require("template/base.php");

?>