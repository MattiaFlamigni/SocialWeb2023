<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "social", 3306);
//define("UPLOAD_DIR", "./upload/");


if (!defined('UPLOAD_DIR')) {
    define('UPLOAD_DIR', './upload/');
}

?>