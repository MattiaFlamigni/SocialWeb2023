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
          <h4>Recupera Password</h4>
        </div>
        <div class="card-body login-form px-20">
          <form action="./util/recover-password.php" method="POST">
            
              <div class="mb-3">
                <label for="mail" class="form-label">Mail</label>
                <input type="text" class="form-control" id="mail" name="mail" required>
                
              </div>
            
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
              
            </div>
            
            <button type="submit" class="login-btn btn btn-primary ltext-white container-fluid">Invia nuova password tramite mail</button>
          </form>

          <a href="index.php" class="">Login</a>
        </div>
       
      </div>
    </div>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
