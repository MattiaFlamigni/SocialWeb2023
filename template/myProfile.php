
<body>

    

    <section class="d-flex justify-content-center">
        <div class="container-fluid mt-3">
            <!-- <div class="rounded-top bg-body-tertiary col-12 col-md-9 mx-auto">
                
                    <img src="img/user.jpg" class="rounded-circle  ms-5 mt-3" alt="utente" width="50" height="50"> Diego Ciprianetti
            </div><!-->

            <div class="row row-cols-1 bg-body-tertiary col-md-9  mx-auto pb-3 pt-3">
                <div class="col  text-center"><img src="img/user.jpg" class="rounded-circle" alt="utente" width="50"
                        height="50"><label class=""><?php echo $templateParams["utente"]["nome"]." ". $templateParams["utente"]["cognome"] ;?> </label></div>

            </div>

            <div class="container-fluid text-center bg-body-tertiary col-12 col-md-9 mx-auto">
                <div class="row">
                    <div class="col order-first border-end border-2">
                        1532
                    </div>
                    <div class="col border-end border-2">
                        4310
                    </div>
                    <div class="col order">
                        1310
                    </div>
                </div>
                <div class="row">
                    <div class="col order-first">
                        Posts
                    </div>
                    <div class="col">
                        Followers
                    </div>
                    <div class="col order-last">
                        Following
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="container-fluid text-center bg-body-tertiary col-12 col-md-9">

        <div class=" ">
            <div class="row row-cols-3">
                
                <?php 
                if(!empty($templateParams["posts"])){
                    foreach ($templateParams["posts"] as $post) : ?>
                <div class="col"><img src="<?php echo UPLOAD_DIR.$post["id"]. '.jpeg' ?>" class="img-fluid rounded m-1"
                        data-like="10"></div>
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
                                <img id="selectedImage" class="img-fluid rounded mb-3" alt="Immagine">
                                <p id="likeCount" class="text-center">Like: <span id="likeNumber">0</span></p>
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

    </main>

    <footer class="bg-body-tertiary w-100 text-center mt-5 pt-5">
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-expand fixed-bottom ">
            <div class="container-fluid">

                <!-- Rimuovi il bottone del toggler -->
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mx-auto">
                        <a class="nav-link" aria-current="page" href="./mainFeed.html"><i
                                class="fa-solid fa-house"></i></a>
                        <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-heart px-5"></i></a>
                        <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-plus fs-4"></i></a>
                        <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-search px-5"></i></a>
                        <a class="nav-link" aria-current="page" href="./profile.html"><i class="fas fa-user "></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
          const imageDetailsModal = new bootstrap.Modal(document.getElementById('imageDetails'));
          const selectedImage = document.getElementById('selectedImage');
          const likeNumber = document.getElementById('likeNumber');
      
          // Aggiungi un gestore di eventi clic a tutte le immagini
          const images = document.querySelectorAll('.img-fluid');
          images.forEach(function (image) {
            image.addEventListener('click', function () {
              // Mostra l'immagine e il numero di like nella finestra modale
              const likeCount = this.getAttribute('data-like') || 0;
              selectedImage.src = this.src;
              likeNumber.textContent = likeCount;
              imageDetailsModal.show();
            });
          });
        });
      </script>

</body>

</html>