<?php


    if(!isset($_SESSION["username"])){
        header("Location: ./index.php");
        exit();
    }?>
    
    
        
            <header class="container d-flex justify-content-between align-items-center">
                <h1><?php $templateParams["titolo_pagina"]  ?></h1>
            </header> 

            <main>
            <?php
                $posts = $dbh->fetchHomePosts($_SESSION["username"]);
                if(!empty($posts)) {
                    foreach ($posts as $post) : ?>
                        <section class="d-flex justify-content-center text-center">
                    <div class="container-fluid mt-3">
                        <div class="rounded-top border bg-body-tertiary col-12 col-md-7 mx-auto">
                            <img src="img/<?php echo $post["username"]?>.jpg" class="rounded-circle" alt="<?php echo $post["username"]?>" width="50" height="50"> <?php echo $post["username"]?>
                        </div>
                        <div class="">
                            <div class="">
                                <img src="img/<?php echo $post["id"] ?>.jpeg" class="img-fluid rounded-bottom col-md-7 " alt="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between col-md-7 container-fluid bg-body-tertiary pt-2">
                            <div class="d-flex">
                                <button type="button" class="btn">
                                    <i class="far fa-heart p-1"></i><label class="px-2">100</label>
                                </button>
                                <a href="commenti.html">
                                    <button type="button" class="btn">
                                        <i class="far fa-comment px-4 py-1"></i>
                                    </button>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </section>

               <?php endforeach; 
            } ?>
            </main>
