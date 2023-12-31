<?php
require_once("../db/database.php");
require_once("../bootstrap.php");

$userInput = $_GET['query'];
$searchResults = $dbh->searchQuery($userInput);

foreach ($searchResults as $row) {
    echo '
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-2">
                    <img src="img/user.jpg" class="img-fluid w-75 rounded-circle" alt="User Image">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h3 class="card-title"><a href="profile.html" class="text-decoration-none text-dark">' . $row["username"] . '</a></h3>
                        <p class="card-text">' . $row["nome"] . ' ' . $row["cognome"] . '</p>
                    </div>
                </div>
            </div>
        </div>';
}
?>

