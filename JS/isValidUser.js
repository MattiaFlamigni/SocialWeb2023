document.getElementById("username").addEventListener("input", function() {
    var username = this.value;
    var resultContainer = document.getElementById("username-check-result");
    var registrazioneBtn = document.getElementById("registrazioneBtn");

    // Esegui la verifica solo se l'input è lungo almeno 3 caratteri
    if (username.length >= 3) {
        // Esegui una richiesta AJAX per verificare l'username
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "check_username.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Gestisci la risposta ricevuta
                resultContainer.innerHTML = xhr.responseText;

                // Disabilita/abilita il bottone in base alla disponibilità dell'username
                if (xhr.responseText.includes("in uso")) {
                    registrazioneBtn.classList.add("disabled");
                } else if(xhr.responseText.includes("disponibile.")){
                    registrazioneBtn.classList.remove("disabled");
                }
            }
        };
        xhr.send("username=" + username);
    } else {
        // Se l'input è troppo breve, svuota il risultato e abilita il pulsante
        resultContainer.innerHTML = "";
        registrazioneBtn.removeAttribute("disabled");
    }
});
