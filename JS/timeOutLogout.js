// dopo 10 minuti di inattivita
const inactivityTimeout = 50 * 60 * 1000; // 1 minute

// Inizializza il timeout e il gestore di timeout
let timeout;
function startInactivityTimeout() {
    timeout = setTimeout(logout, inactivityTimeout);
}

// Resetta il timeout quando c'è attività
function resetInactivityTimeout() {
    clearTimeout(timeout);
    startInactivityTimeout();
}

// Funzione di logout
function logout() {
    // Qui puoi aggiungere la logica per disconnettere l'utente, ad esempio reindirizzando alla pagina di logout
    alert("Hai eseguito il logout automatico per inattività");
    window.location.href = "util/logout.php";
}

// Registra eventi di attività (ad esempio, clic del mouse o pressione dei tasti)
document.addEventListener("mousemove", resetInactivityTimeout);
document.addEventListener("keydown", resetInactivityTimeout);
document.addEventListener("wheel", resetInactivityTimeout);
document.addEventListener("touchmove", resetInactivityTimeout);

// Avvia il timeout iniziale
startInactivityTimeout();