<header class="bg-success text-white text-center py-4">
    <h1 class="mb-0">Web</h1>
    <div class="container">
        <nav class="mt-3">
            <form class="d-flex">
                <input id="search-input" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light disabled" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </nav>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-success mb-4">Search results</h2>
                <div id="search-results"><p>Effettua una ricerca </p></div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Aggiungi un gestore per l'evento di input sulla casella di ricerca
    document.getElementById("search-input").addEventListener("input", function () {
        // Ottieni il valore digitato dall'utente
        var userInput = this.value;

        // Fai una richiesta al server per ottenere i suggerimenti
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Aggiorna il contenuto dei suggerimenti con la risposta del server
                console.log("Stampa di debug"); //funziona
                document.getElementById("search-results").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "util/suggest.php?query=" + encodeURIComponent(userInput), true);
        xhr.send();
    });
});
</script>
