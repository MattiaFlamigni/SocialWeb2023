mail.addEventListener("input", function() {
    let mail = document.getElementById("mail").value;
    let mailResult = document.getElementById("mail-check-result");

    
    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(mail)) {
        mailResult.innerHTML = "Inserisci una mail valida";
        //document.getElementById("registrazioneBtn").disabled = false;
    } else {
        mailResult.innerHTML = "";  // Resetta il messaggio se la password è valida
        document.getElementById("registrazioneBtn").classList.remove("disabled");     
    }
});
