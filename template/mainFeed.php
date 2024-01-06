
    <style>
        .liked {
            color: red;
        }
    </style>


<?php
require("bootstrap.php");
if (count($templateParams["posts"]) > 0) {
    foreach ($templateParams["posts"] as $post):
        ?>
        <section class="d-flex justify-content-center text-center">
            <div class="container-fluid mt-3">
                <div class="rounded-top border bg-body-tertiary col-12 col-md-7 mx-auto">
                    <!-- Utente che ha condiviso la foto -->
                    <img src="./img/user.jpg" class="rounded-circle " alt="utente" width="50" height="50">
                    <?php echo str_replace("./upload/", "", UPLOAD_DIR . $post["username"]) ?>
                </div>
                <div class="">
                    <div class="">
                        <img src="<?php echo glob(UPLOAD_DIR.$post["id"] . '.*')[0]; ?>"
                            class="img-fluid rounded-bottom col-md-7 " alt="">

                    </div>
                    <div class="container-fluid col-7 bg-body-tertiary pb-3">
                        <p><?php echo $post["descrizione"]?></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between col-md-7 container-fluid bg-body-tertiary pt-2 border-top">
                    <div class="d-flex">
                        <form class="like-form" action="util/like.php" method="POST">
                            <button type="button" onclick="handleLike(this)"
                                    data-post-id="<?php echo $post["id"]; ?>"
                                    aria-label="Like"
                                    class="btn <?php echo ($dbh->isLiked($_SESSION["username"], $post["id"])) ? 'liked' : ''; ?> mb-2">
                                <i class="far fa-heart p-1"></i><span
                                        class="px-2"><?php echo $dbh->getNumLikeToPost($post["id"]) ?></span>
                            </button>
                            <input type="hidden" name="postId" value="<?php echo $post["id"] ?>">
                            
                            
                        </form>
                        <form action="template/commenti.php" method="GET">
                            <button type="submit" aria-label="Commenti" class="btn">
                                <i class="far fa-comment px-4 py-1"></i>
                            </button>
                            <input type="hidden" name="postId" value="<?php echo $post["id"] ?>">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endforeach;
} else {
    ?>
    <div class="mt-5 container justify-content-center">
        <h2>E' un po' vuoto qua, inizia a seguire qualcuno!</h2>
    </div>
    <?php
}
?>

<script>
    function handleLike(button) {
    let postId = button.getAttribute('data-post-id');
    let formData = new FormData();
    formData.append('postId', postId);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'util/like.php', true);

    xhr.onload = async function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let likeButton = button;
                let likeCount = likeButton.querySelector('span');
                let isLiked = likeButton.classList.contains('liked');

                if (isLiked) {
                    likeButton.classList.remove('liked');
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                    likeButton.style.color = "black";
                } else {
                    likeButton.classList.add('liked');
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;
                    // colora il cuore di rosso
                    likeButton.style.color = "red";

                    // Invia la mail in modo asincrono
                    try {
                        let response = await fetch('util/sendMail.php', {
                            method: 'POST',
                            body: formData
                        });

                        if (response.ok) {
                            // Gestisci la risposta in base alle tue esigenze

                        } else {
                            console.error('Failed to send mail');
                        }
                    } catch (error) {
                        console.error('Error during mail sending:', error);
                    }
                }
            } else {
                console.log('Error: ' + xhr.status);
            }
        }
    };

    xhr.send(formData);
}

</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>




