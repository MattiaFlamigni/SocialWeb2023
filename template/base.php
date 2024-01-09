<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php switch($templateParams["nome"]) {





        case "login.html" :
            echo('<link href="CSS/authentication.css" rel="stylesheet" type="text/css">');
            break;

        case "registrati.php" :
            echo('<link href="CSS/authentication.css" rel="stylesheet">');
            break;

        case "mainFeed.php" :
            echo('<link href="CSS/mainFeed.css" rel="stylesheet">');
            break;
    }
        
    ?>      
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iK16H3StjBvfxqSBXAm12XtwW1l75Vg5WBE5iP5S62XVtFkF+bpXQtXWo" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3e59e20392.js" crossorigin="anonymous"></script>
    <script src="JS/timeOutLogout.js"></script>
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
                require('template/' . $templateParams["nome"]);
            ?>
        </main>
        <?php if (!isset($templateParams["nascondi_footer"]) || !$templateParams["nascondi_footer"]) : ?>
            <footer class="bg-body-tertiary w-100 text-center mt-5 pt-5" >
                <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-expand fixed-bottom ">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav mx-auto">
    <a class="nav-link" aria-current="page" href="mainFeed.php">
        <em class="fa-solid fa-house"></em>
        <span class="visually-hidden">Home</span>
    </a>

    <a class="nav-link" aria-current="page" href="likes.php">
        <em class="fa-solid fa-heart px-5"></em>
        <span class="visually-hidden">Likes</span>
    </a>

    <a class="nav-link" aria-current="page" href="createPost.php">
        <em class="fa-solid fa-plus fs-4"></em>
        <span class="visually-hidden">Create Post</span>
    </a>

    <a class="nav-link" aria-current="page" href="search.php">
        <em class="fa-solid fa-search px-5"></em>
        <span class="visually-hidden">Search</span>
    </a>

    <a class="nav-link" aria-current="page" href="myProfile.php?username=<?php echo $_SESSION['username']; ?>">
        <em class="fas fa-user"></em>
        <span class="visually-hidden">My Profile</span>
    </a>

    <a class="col nav-link d-flex justify-content-center" aria-current="page" href="util/logout.php">
        <em class="fa-solid fa-right-from-bracket mx-3"></em>
        <span class="visually-hidden">Logout</span>
    </a>
</div>

                        </div>
                    </div>
                </nav>    
            </footer>
        <?php endif; ?>
    </body>
</html>