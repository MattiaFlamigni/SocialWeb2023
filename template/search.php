
    <header class="bg-success text-white text-center py-4">
        <h1 class="mb-0">Web</h1>
        <div class="container">
            <nav class="mt-3">
                <form class="d-flex">
                    <input id="search-input"  class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </nav>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-success mb-4">Search results</h2>
                    <div id="search-results"> <p>Effettua una ricerca </p>
                    </div>
                </div>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
$(document).ready(function() {
    // Aggiungi un gestore per l'evento di input sulla casella di ricerca
    $("#search-input").on("input", function() {
        // Ottieni il valore digitato dall'utente
        var userInput = $(this).val();

        

        // Fai una richiesta al server per ottenere i suggerimenti
        $.ajax({
            url: "util/suggest.php", // Sostituisci con il percorso del tuo script PHP per ottenere i suggerimenti
            method: "GET",
            data: { query: userInput },
            success: function(data) {
                // Aggiorna il contenuto dei suggerimenti con la risposta del server
                console.log("Stampa di debug"); //funziona
                $("#search-results").html(data);
            }
        });
    });
});
</script>






