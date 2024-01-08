<?php
require_once("bootstrap.php");

$postToComment = $_POST['postId'];
$templateParams["titolo"] = "commenti";
$templateParams["titolo_pagina"] = "commenti";
$templateParams["nome"] = "commenti.php";

/*$templateParams["posts"] = $dbh->getPostsByUser($_SESSION["username"]);
$templateParams["utente"] = $dbh->getUserByUsername($_SESSION["username"]);

$templateParams["numPost"] = $dbh->getNumPosts($_SESSION["username"]);
$templateParams["numFollowing"] = $dbh->getNumFollowing($_SESSION["username"]);
$templateParams["numFollowers"] = $dbh->getNumFollowers($_SESSION["username"]);*/


$templateParams["comments"] = $dbh->listComments($postToComment); 


require("template/base.php");

?>