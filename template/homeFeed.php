<?php
    require_once("bootstrap.php");
    if(!isset($_SESSION["username"])){
        header("Location: ./index.php");
        exit();
    }?>
    
    <!doctype html>
    <html lang="it">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iK16H3StjBvfxqSBXAm12XtwW1l75Vg5WBE5iP5S62XVtFkF+bpXQtXWo" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/3e59e20392.js" crossorigin="anonymous"></script>
            <link href="CSS/mainFeed.css" rel="stylesheet" type="text/css">
            <title>Main Page</title>

            <style>
                body{
                    /*gradiente verde  molto chiaro da alto a basso*/
                    background: linear-gradient(to bottom, #d1e7dd, #fff);
                }
            </style>
            
        </head>
        <body>
    

        
            <header class="container d-flex justify-content-between align-items-center">
                <h1>Web</h1>
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

            <footer class="bg-body-tertiary w-100 text-center mt-5 pt-5">
                <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-expand fixed-bottom ">
                    <div class="container-fluid">
                            
                        <!-- Rimuovi il bottone del toggler -->
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav mx-auto">
                                <a class="nav-link" aria-current="page" href="mainFeed.php"><i class="fa-solid fa-house"></i></a>
                                <a class="nav-link" aria-current="page" href="likes.php"><i class="fa-solid fa-heart px-5"></i></a>
                                <a class="nav-link" aria-current="page" href="createPost.php"><i class="fa-solid fa-plus fs-4"></i></a>
                                <a class="nav-link" aria-current="page" href="search.php"><i class="fa-solid fa-search px-5"></i></a>                                    
                                <a class="nav-link" aria-current="page" href="myProfile.php"><i class="fas fa-user "></i></a>
                            </div>
                        </div>
                    </div>
                </nav>    
            </footer>
            
        </body>
    </html>