

            <?php 

            foreach($templateParams["posts"] as $post): ?>

            <section class="d-flex justify-content-center text-center">
                <div class="container-fluid mt-3">
                    <div class="rounded-top border bg-body-tertiary col-12 col-md-7 mx-auto">
                        <!-- Utente che ha condiviso la foto -->    
                        <img src="./img/user.jpg" class="rounded-circle " alt="utente" width="50" height="50"> Username
                    </div>
                    <div class="">
                        <div class="">
                            <img src="<?php echo UPLOAD_DIR.$post["id"]. '.jpeg' ?>" class="img-fluid rounded-bottom col-md-7 " alt="">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between col-md-7 container-fluid bg-body-tertiary pt-2">
                        <div class="d-flex">
                            <button type="button" aria-label="Like" class="btn">
                                <i class="far fa-heart p-1"></i><span class="px-2">100</span>
                            </button>
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


            