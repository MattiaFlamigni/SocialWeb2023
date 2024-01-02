<?php
require_once("bootstrap.php");
require("template/homeFeed.php");
$templateParams["postfollowposts"] = $dbh->fetchHomePosts($_SESSION["username"]);
$templateParams["utente"] = $dbh->getUserByUsername($_SESSION["username"]);



?>