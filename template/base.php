    <!doctype html>
    <html lang="it">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
           
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iK16H3StjBvfxqSBXAm12XtwW1l75Vg5WBE5iP5S62XVtFkF+bpXQtXWo" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/3e59e20392.js" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
                integrity="sha384-GLhlTQ8iK16H3StjBvfxqSBXAm12XtwW1l75Vg5WBE5iP5S62XVtFkF+bpXQtXWo" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/3e59e20392.js" crossorigin="anonymous"></script>
            <link href="CSS/home.css" rel="stylesheet" type="text/css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script src="JS\timeOutLogout.js"></script>
            
            <title><?php echo $templateParams["titolo"]; ?></title>

            <style>
                body{
                    /*gradiente verde  molto chiaro da alto a basso*/
                    background: linear-gradient(to bottom, #d1e7dd, #fff);
                }
            </style>
            
        </head>
        <body>

            <header><?php echo $templateParams["titolo_pagina"]; ?></header>

            <main>  
                <?php
                    require($templateParams["nome"]);
                ?>
            </main>




            <?php if (!isset($templateParams["nascondi_footer"]) || !$templateParams["nascondi_footer"]) : ?>
                <footer class="bg-body-tertiary w-100 text-center mt-5 pt-5">
                <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-expand fixed-bottom ">
                    <div class="container-fluid">
                            
                        <!-- Rimuovi il bottone del toggler -->
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav mx-auto">
                                <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-house"></i></a>
                                <a class="nav-link" aria-current="page" href="likes.php"><i class="fa-solid fa-heart px-5"></i></a>
                                <a class="nav-link" aria-current="page" href="createPost.php"><i class="fa-solid fa-plus fs-4"></i></a>
                                <a class="nav-link" aria-current="page" href="search.php"><i class="fa-solid fa-search px-5"></i></a>                                    
                                <a class="nav-link" aria-current="page" href="myProfile.php"><i class="fas fa-user "></i></a>
                            </div>

                            <!-- icona del logout -->

                            <a class="nav-link" aria-current="page" href="util/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>

                        </div>"
                    </div>
                </nav>    
            </footer>
        <?php endif; ?>

            
            
        </body>
    </html>