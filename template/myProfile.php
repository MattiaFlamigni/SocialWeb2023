


    <?php
    if(!isset($_SESSION["username"])){
        header("Location: ./index.php");
        exit();
    }?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="changePassword.php">Cambia Password</a>
                <a class="nav-link" href="util/logout.php">LogOut </a>
            </li>
        </ul>
    </div>
</nav>

    <section class="d-flex justify-content-center">
        <div class="container-fluid mt-3 col-md-12">
            <!-- <div class="rounded-top bg-body-tertiary col-12 col-md-9 mx-auto">
                
                    <img src="img/user.jpg" class="rounded-circle  ms-5 mt-3" alt="utente" width="50" height="50"> Diego Ciprianetti
            </div><!-->

            <div class="row row-cols-1 bg-body-tertiary col-md-9  mx-auto pb-3 pt-3" >
                <div class="col  text-center"><img src="img/user.jpg" class="rounded-circle" alt="utente" width="50"
                        height="50"><label class=""><?php 
                                                    if(isset($templateParams["utente"]["nome"])){
                                                        echo $templateParams["utente"]["nome"]." ". $templateParams["utente"]["cognome"];
                                                    } ?>  </label>
                </div>

            </div>

            <div class="container-fluid text-center bg-body-tertiary col-12 col-md-9 mx-auto" >
                <div class="row">
                    <div class="col order-first border-end border-2">
                        <?php echo $templateParams["numPost"]; ?>
                    </div>
                    <div class="col border-end border-2">
                        <?php echo $templateParams["numFollowers"]; ?>
                    </div>
                    <div class="col order">
                        <?php echo $templateParams["numFollowing"]; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col order-first">
                        Posts
                    </div>
                    <div class="col">
                        <a href="showProfile.php?type=followers">Followers</a>
                    </div>
                    <div class="col order-last">
                        <a href="showProfile.php?type=following">Following</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container text-center bg-body-tertiary col-11 col-md-9">

        <div class=" ">
            <div class="row row-cols-3">
                
                <?php 
                if(!empty($templateParams["posts"])){
                    foreach ($templateParams["posts"] as $post) : ?>
                <div class="col"><img data-post-id="<?php echo $post["id"]; ?>"  data-description="<?php /*echo $dbh->getDescription($post["id"])*/  echo $post["descrizione"];?>" src="<?php echo glob(UPLOAD_DIR . $post["id"] . ".*")[0]; ?>" class="img-fluid rounded m-1"
                        data-like="<?php echo $dbh->getNumLikeToPost($post["id"]); ?>"></div>
                <!--<div class="col"><img src="./img/amsterdam.jpeg" class="img-fluid rounded m-1" data-like="10"></div> !-->
                <!-- Aggiungi questa sezione dopo la sezione delle immagini nel tuo file HTML -->
                <div id="imageDetails" class="modal fade" tabindex="-1" aria-labelledby="imageDetailsLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageDetailsLabel">Dettagli Immagine</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Chiudi"></button>
                            </div>
                            <div class="modal-body">
                                <img id="selectedImage" src="#" class="img-fluid rounded mb-3" alt="Immagine">
                                <p id="likeCount" class="text-center">Like: <span id="likeNumber">0</span></p>
                                <p id="imageDescription" class="text-center"></p>
                                <a id="viewCommentsBtn" class="btn btn-primary">Visualizza Commenti</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

            <?php } else{ ?>
                <div class="mt-5 container justify-content-center">
                    <h3>Non hai ancora postato nulla</h3>
                </div>
            <?php }  ?>
        </div>

            </section>

    


    <!-- ... Il tuo HTML rimane invariato ... -->

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageDetailsModal = new bootstrap.Modal(document.getElementById('imageDetails'));
        const selectedImage = document.getElementById('selectedImage');
        const likeNumber = document.getElementById('likeNumber');
        const imageDescription = document.getElementById('imageDescription');
        const viewCommentsBtn = document.getElementById('viewCommentsBtn'); // Dichiarato qui

        // Aggiungi un gestore di eventi clic a tutte le immagini
        const images = document.querySelectorAll('.img-fluid');
        images.forEach(function (image) {
            image.addEventListener('click', function () {
                // Mostra l'immagine e il numero di like nella finestra modale
                const likeCount = this.getAttribute('data-like') || 0;
                const description = this.getAttribute('data-description') || '';
                selectedImage.src = this.src;
                likeNumber.textContent = likeCount;
                imageDescription.textContent = description;

                // Aggiungi il link all'immagine selezionata
                const postId = this.getAttribute('data-post-id');
                viewCommentsBtn.setAttribute('href', 'template/commenti.php?postId=' + postId);

                // Mostra la finestra modale
                imageDetailsModal.show();
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarNav = document.querySelector('#navbarNav');

        navbarToggler.addEventListener('click', function () {
            navbarNav.classList.toggle('show');
        });
    });
</script>


