<?php
require_once("../db/database.php");
require_once("../bootstrap.php");

$userInput = $_GET['query'];
$searchResults = $dbh->searchQuery($userInput);

foreach ($searchResults as $row) {
    echo '
        <div class="card mb-4">
            <div class="row g-0">
                
                <div class="col-md-10">
                    <div class="card-body">';
                    
                    if($row["username"] &&  $profilePicURL = $dbh->getProPic($row["username"])){
                        echo '<img src="' . propic_url($profilePicURL) . '" class="img-fluid w-75 rounded-circle" alt="User Image">';
                        
                    }else{
                        echo '<img src="profile_pic/user.jpg" class="img-fluid w-75 rounded-circle" alt="">';
                    }
                    

                    echo '
                    <h3 class="card-title"><a href="profile.php?username=' . $row["username"] . '" class="text-decoration-none text-dark">' . $row["username"] . '</a></h3>
                        <p class="card-text">' . $row["nome"] . ' ' . $row["cognome"] . '</p>
                    </div>
                </div>
            </div>
        </div>';
}



function propic_url($id) {
	return glob(PIC_DIR . "/$id.*")[0];
}
?>

