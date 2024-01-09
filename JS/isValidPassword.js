document.addEventListener("DOMContentLoaded", function() {
    let passwordInput = document.getElementById("password");
    let mail = document.getElementById("mail");

    passwordInput.addEventListener("input", function() {
        let password = document.getElementById("password").value;
        let passwordResult = document.getElementById("password-check-result");

        // La password deve contenere almeno un carattere maiuscolo e almeno un numero
        if (!/[A-Z]/.test(password) || !/\d/.test(password) || password.length < 8) {
            passwordResult.innerHTML = "La password deve contenere un <strong>carattere maiuscolo</strong>, un <strong>numero</strong> e una <strong>lunghezza</strong> superiore a <strong>8</strong>.";
            //document.getElementById("registrazioneBtn").disabled = false;
        } else {
            passwordResult.innerHTML = "";  // Resetta il messaggio se la password è valida
            document.getElementById("registrazioneBtn").classList.remove("disabled");     
        }
    });
});