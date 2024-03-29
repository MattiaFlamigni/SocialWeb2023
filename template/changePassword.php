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
<div class="container pt-1">
  <div class="row justify-content-center">
    <div class="col-md-6 login-container bg-transparent rounded overflow-hidden" style="max-width: 400px;">
      <div class="card">
        <div class="card-header login-card-header p-20 text-center text-white bg-dark">
          <h4>Reset Password</h4>
        </div>
        <div class="card-body login-form px-20">
        <form action="util/reset.php" method="POST">

<div class="mb-3">
    <label for="oldPassword" class="form-label">Password Attuale</label>
    <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
</div>

<div class="mb-3">
    <label for="password" class="form-label">Nuova Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
    <div id="password-check-result" aria-live="polite" role="status"></div>
</div>

<div class="mb-3">
    <label for="password2" class="form-label">Conferma Nuova Password</label>
    <input type="password" class="form-control" id="password2" name="password2" required>
    <div id="password2-check-result" aria-live="polite" role="status"></div>
</div>

<button type="submit" id="resetBtn" class="login-btn btn btn-primary text-white container-fluid" >Reset Password</button>
</form>


          <a href="index.php" class="">Login</a>
        </div>
       
      </div>
    </div>
  </div>
</div>




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
              //document.getElementById("registrazioneBtn").classList.remove("disabled");
              
              
          }
      });


      mail.addEventListener("input", function() {
          let mail = document.getElementById("mail").value;
          let mailResult = document.getElementById("mail-check-result");

          
          if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(mail)) {
              mailResult.innerHTML = "Inserisci una mail valida";
              document.getElementById("registrazioneBtn").disabled = false;
          } else {
              mailResult.innerHTML = "";  // Resetta il messaggio se la password è valida
              document.getElementById("registrazioneBtn").classList.remove("disabled");
              
          }
      });
  });
</script>

<script src="JS/checkPassword.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

