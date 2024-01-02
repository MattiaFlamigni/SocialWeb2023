<?php

require_once("../bootstrap.php");

$dbh->resetPassword($_SESSION["username"], $_POST["password"]);

header("Location: ../myProfile.php");


?>