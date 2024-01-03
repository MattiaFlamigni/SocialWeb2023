<?php 
require("bootstrap.php");

if(count($templateParams["posts"]) > 0){
    foreach($templateParams["posts"] as $post): ?>
        <section class="d-flex justify-content-center text-center">
            <div class="container-fluid mt-3">
                <div class="rounded-top border bg-body-tertiary col-12 col-md-7 mx-auto">
                    <!-- Utente che ha condiviso la foto -->    
                    <img src="./img/user.jpg" class="rounded-circle " alt="utente" width="50" height="50"> <?php echo str_replace("./upload/", "",UPLOAD_DIR.$post["username"]) ?>
                </div>
                <div class="">
                    <div class="">
                        <img src="<?php echo UPLOAD_DIR.$post["id"]. '.jpeg' ?>" class="img-fluid rounded-bottom col-md-7 " alt="">
                    </div>
                </div>
                <div class="d-flex justify-content-between col-md-7 container-fluid bg-body-tertiary pt-2">
                    <div class="d-flex">

                        
                        <script>
                            if(document.getElementById("likeButton").classList.contains("liked")){
                                //colora il bottone di colore primario
                                document.getElementById("likeButton").classList.add("btn-primary");
                            } else{
                                document.getElementById("likeButton").classList.remove("btn-primary");
                            }
                        </script>
                        <form action="util/like.php" method="GET">
                        <button type="submit" id="likeButton" aria-label="Like" class="btn <?php echo ($dbh->isLiked($_SESSION["username"], $post["id"])) ? 'liked' : ''; ?> mb-2">
                            <i class="far fa-heart p-1"></i><span class="px-2"><?php echo $dbh->getNumLikeToPost($post["id"]) ?></span>
                        </button>

                            <input type="hidden" name="postId" value="<?php echo $post["id"] ?>">
                        </form>
                        <a href="commenti.html" aria-label="vai ai commenti">
                            <button type="button"  class="btn">
                                <i class="far fa-comment px-4 py-1"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php } else{ ?>
    <div class="mt-5 container justify-content-center">
        <h2>E' un po' vuoto qua, inizia a seguire qualcuno!</h2>
    </div>

    <?php }
      
?>

<script>
    document.getElementById("likeButton").addEventListener("click", function(){
        if(this.classList.contains("liked")){
            //colora il bottone di colore primario
            this.classList.add("btn-primary");
        } else{
            this.classList.remove("btn-primary");
        }   
    });
</script>