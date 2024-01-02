<?php

require_once("../bootstrap.php");

$result = $dbh->checkOldPassword($_SESSION["username"], $_POST["oldPassword"]);
if ($result) {
    if ($dbh->resetPassword($_SESSION["username"], $_POST["password"])) {
        echo '<script>alert("Password cambiata con successo!");';
    } else {
        echo '<script>alert("Errore durante il cambio della password!");';
    }
} else {
    echo '<script>alert("Password errata!");';
}


echo 'window.location.href="../myProfile.php";</script>';

?>
