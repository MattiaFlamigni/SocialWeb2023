<?php

require_once("../db/database.php");
require_once("../bootstrap.php");
require_once("./Mailer.php");
session_start();

$postToComment = $_POST['postId'];


$dbh->addComment($commentText, $postToComment);

//$mailer = new Mailer();
//$mailer->sendMail("flami2002@gmail.com", $dbh->getMailFromUser($dbh->getUsernameByPost($postToLike)), "Nuovo Like!", "Ciao " . $dbh->getNomeByPost($postToLike) . ", " . $_SESSION["username"] . " ti ha appena messo like ad un post!");

?>