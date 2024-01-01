<?php

require_once("../db/database.php");
require_once("../bootstrap.php");
require_once("./Mailer.php");
session_start();

$userToFollow = $_GET['username'];



if($dbh->isFollowing($_SESSION["username"], $userToFollow)){
    $dbh->unfollowUser($_SESSION["username"], $userToFollow);
    header("Location: ../profile.php?username=" . $userToFollow);
    exit;
}

$dbh->followUser($_SESSION["username"], $userToFollow);

$mailer = new Mailer();
$mailer->sendMail("flami2002@gmail.com", $dbh->getMailFromUser($userToFollow), "Nuovo follower!", "Ciao " . $dbh->getNomeByUsername($userToFollow) . ", " . $_SESSION["username"] . " ti ha appena seguito!");














header("Location: ../profile.php?username=" . $userToFollow);




?>