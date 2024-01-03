<?php

require_once("../db/database.php");
require_once("../bootstrap.php");
require_once("./Mailer.php");
session_start();

$postToLike = $_GET['postId'];



if($dbh->isLiked($_SESSION["username"], $postToLike)){
    $dbh->removeLike($_SESSION["username"], $postToLike);
    //voglio tornare alla stessa pagina alla stessa posizione del post
    header("Location: ../mainFeed.php#post" . $postToLike);
    exit;
}

$dbh->likePost($_SESSION["username"], $postToLike);

$mailer = new Mailer();
$mailer->sendMail("flami2002@gmail.com", $dbh->getMailFromUser($postToLike), "Nuovo Like!", "Ciao " . $dbh->getNomeByPost($postToLike) . ", " . $_SESSION["username"] . " ti ha appena messo like ad un post!");


header("Location: ../mainFeed.php#post" . $postToLike);

?>