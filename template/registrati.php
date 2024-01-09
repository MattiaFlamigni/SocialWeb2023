<div class="container pt-1">
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
                <label for="surname" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
              <div class="mb-3">
                <label for="mail" class="form-label">Mail</label>
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
            <div class="mb-3">
              <label for="password2" class="form-label">Conferma Password</label>
              <input type="password" class="form-control" id="password2" name="password" required>
              <div id="password2-check-result"></div>
            </div>
            <button type="submit" id="registrazioneBtn" class="login-btn btn btn-primary ltext-white container-fluid disabled">Registrati</button>
          </form>

          <a href="index.php" class="">Login</a>
        </div>


      </div>
    </div>
  </div>
</div>



<script src="JS/checkPassword.js"></script>
<script src="JS/isValidUser.js"></script>
<script src="JS/isValidMail.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/isValidPassword.js"></script>