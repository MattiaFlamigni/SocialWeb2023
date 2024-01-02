<?php

require_once("../db/database.php");
require_once("../bootstrap.php");

    session_start();


    echo "Login in corso...<br>";
    $username = $_POST["username"];
    $password = $_POST["password"];

    var_dump($username);
    var_dump($password);

    $result = $dbh->login($username, $password);
    $exists = $dbh->userExists($username);

    if($exists === false){
        echo '<script>alert("Utente non registrato!");</script>';
 
        header("Refresh:0; url=../registrati.php");

        exit();
    }

    if ($result === false) {
        echo '<script>alert("Password errata!");</script>';
 
        header("Refresh:0; url=../index.php");
    } else {

        $_SESSION["username"] = $username;
        
        header("Refresh:0; url=../mainFeed.php");
        
    }


?>

