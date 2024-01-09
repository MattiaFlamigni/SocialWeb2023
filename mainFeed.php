<?php
require_once("bootstrap.php");


$templateParams["titolo"] = "Home";
$templateParams["titolo_pagina"] = "";
$templateParams["nome"] = "mainFeed.php";

$templateParams["posts"] = $dbh->fetchHomePosts($_SESSION["username"]);

require("template/base.php");

?>