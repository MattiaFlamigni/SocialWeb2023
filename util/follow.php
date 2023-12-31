<?php

require_once("../db/database.php");
require_once("../bootstrap.php");
session_start();

$userToFollow = $_GET['username'];



if($dbh->isFollowing($_SESSION["username"], $userToFollow)){
    $dbh->unfollowUser($_SESSION["username"], $userToFollow);
    header("Location: ../profile.php?username=" . $userToFollow);
    exit;
}

$dbh->followUser($_SESSION["username"], $userToFollow);












header("Location: ../profile.php?username=" . $userToFollow);




?>