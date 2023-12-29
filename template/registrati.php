<style>
  body {
    background: linear-gradient(45deg, #2d6d84, #9d4edd);
    height: 100vh;
    align-items: center;
    justify-content: center;
    margin: 0;
  }

  .login-container {
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
  }

  .login-btn {
    background-color: #9d4edd;
    transition: background-color 0.3s ease-in-out;
  }

  .login-btn:hover {
    background-color: #6a2c70;
  }
</style>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 login-container bg-transparent rounded overflow-hidden" style="max-width: 400px;">
      <div class="card">
        <div class="card-header login-card-header p-20 text-center text-white bg-dark">
          <h4>Registrati</h4>
        </div>
        <div class="card-body login-form px-20">
          <form action="util/registrazione.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Mail</label>
                <input type="text" class="form-control" id="mail" name="mail" required>
                <div id = "mail-check-result"></div>
              </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
              <div id="username-check-result"></div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <div id="password-check-result"></div>
            </div>
            <button type="submit" id="registrazioneBtn" class="login-btn btn btn-primary ltext-white container-fluid disabled">Registrati</button>
          </form>

          <a href="" class="">Login</a>
        </div>
       
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("username").addEventListener("input", function() {
      var username = this.value;
      var resultContainer = document.getElementById("username-check-result");
  
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

                  // Disabilita il bottone se l'username è già in uso
                if (xhr.responseText.includes("in uso")) {
                    registrazioneBtn.disabled = true;
                } else {
                    registrazioneBtn.disabled = false;
                }
              }
          };
          xhr.send("username=" + username);
      } else {
          // Se l'input è troppo breve, svuota il risultato
          resultContainer.innerHTML = "";
      }
  });
  </script>


<script>
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
  });
</script>



  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

