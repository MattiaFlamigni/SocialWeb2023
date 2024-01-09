<?php
require_once("../db/database.php");
include_once("../bootstrap.php");
include_once("bootstrap.php");
include_once("post.php");

$userInput = $_GET['query'];
$searchResults = $dbh->searchQuery($userInput);

foreach ($searchResults as $row) {
    echo '
        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-10">
                    <div class="card-body">

                        <img src="' . propic_url($dbh->getProPic($row["immagine_profilo"])) . '" class=" rounded-circle" alt="User Image" width="50" height="50">

                    <h3 class="card-title"><a href="profile.php?username=' . $row["username"] . '" class="text-decoration-none text-dark">' . $row["username"] . '</a></h3>
                        <p class="card-text">' . $row["nome"] . ' ' . $row["cognome"] . '</p>
                    </div>
                </div>
            </div>
        </div>';
}



/*function propic_url($id) {
	return glob(PIC_DIR . "/$id.*")[0];
}
?>*/

