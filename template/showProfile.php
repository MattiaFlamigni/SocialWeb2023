

<?php

require_once("bootstrap.php");
require_once("util/post.php");


if (!isset($_SESSION["username"])) {
    header("Location: ./index.php");
    exit();
}

if (isset($_GET["type"])) {
    $type = $_GET["type"];

    if ($type == "followers") {
        foreach ($templateParams["followers"] as $follower) {
            echo '<div class="card mb-4">
    <div class="row g-0">
        <div class="col-md-2">';
        
// Verifica se l'immagine del profilo è settata
if ($follower["username_utente"] && ($profilePicURL = $dbh->getProPic($follower["username_utente"]))) {
    echo '<img src="' . propic_url($profilePicURL) . '" class="img-fluid w-75 rounded-circle" alt="User Image">';
} else {
    // Se l'immagine del profilo non è settata, usa un'immagine di default
    echo '<img src="profile_pic\user.jpg" class="img-fluid w-75 rounded-circle" alt="Default User Image">';
}

echo '</div>
        <div class="col-md-10">
            <div class="card-body mt-4">
                <h3><a href="profile.php?username=' . $follower["username_utente"] . '" class="text-decoration-none text-dark">' . $follower["username_utente"] . '</a></h3>
            </div>
        </div>
    </div>
</div>';


        }
    } else if ($type == "following") {
        foreach ($templateParams["following"] as $following) {
            echo '<div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-2">';

                    if ($following["username_seguito"] && ($profilePicURL = $dbh->getProPic($following["username_seguito"]))) {
                        echo '<img src="' . propic_url($profilePicURL) . '" class="img-fluid w-75 rounded-circle" alt="User Image">';
                    }else{
                        echo '<img src="profile_pic/user.jpg" class="img-fluid w-75 rounded-circle" alt="User Image">';
                    }
                    echo '</div>
                    <div class="col-md-10">
                        <div class="card-body mt-4">
                        <h3><a href="profile.php?username=' . $following["username_seguito"] . '" class="text-decoration-none text-dark">' . $following["username_seguito"] . '</a></h3>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    






