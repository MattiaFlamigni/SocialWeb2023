//controlla che le due password siano uguali
document.addEventListener("DOMContentLoaded", function() {
    let passwordInput = document.getElementById("password");
    let passwordInput2 = document.getElementById("password2");

    passwordInput2.addEventListener("input", function() {
        let password = document.getElementById("password").value;
        let password2 = document.getElementById("password2").value;
        let passwordResult = document.getElementById("password2-check-result");

        if (password != password2) {
            passwordResult.innerHTML = "<strong>Le password non coincidono</strong>";
              
        } else {
            passwordResult.innerHTML = "";  // Resetta il messaggio se la password è valida
            document.getElementById("registrazioneBtn").classList.remove("disabled");         
        }
    });
});