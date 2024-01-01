<?php
require_once("bootstrap.php");

session_start();

$templateParams["titolo"] = "Home Page";
$templateParams["titolo_pagina"] = "Home Page";
$templateParams["nome"] = "mainFeed.php";

$templateParams["posts"] = $dbh->fetchHomePosts($_SESSION["username"]);
$templateParams["utente"] = $dbh->getUserByUsername($_SESSION["username"]);
require("template/base.php");

?>