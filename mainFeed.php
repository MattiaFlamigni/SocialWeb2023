<?php
require_once("bootstrap.php");


$templateParams["titolo"] = "feed";
$templateParams["titolo_pagina"] = "feed";
$templateParams["nome"] = "mainFeed.php";

/*$templateParams["posts"] = $dbh->getPostsByUser($_SESSION["username"]);
$templateParams["utente"] = $dbh->getUserByUsername($_SESSION["username"]);

$templateParams["numPost"] = $dbh->getNumPosts($_SESSION["username"]);
$templateParams["numFollowing"] = $dbh->getNumFollowing($_SESSION["username"]);
$templateParams["numFollowers"] = $dbh->getNumFollowers($_SESSION["username"]);*/


$templateParams["posts"] = $dbh->fetchHomePosts($_SESSION["username"]);

require("template/base.php");

?>