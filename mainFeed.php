<?php
require_once("bootstrap.php");


$templateParams["titolo"] = "feed";
$templateParams["titolo_pagina"] = "feed";
$templateParams["nome"] = "mainFeed.php";

$templateParams["posts"] = $dbh->fetchHomePosts($_SESSION["username"]);

require("template/base.php");

?>