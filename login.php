<?php 
require 'config.php';

if(isset($_POST['submit'])) {
  session_start();
  $_SESSION['fullname'] = $_POST['fullname'];
  $_SESSION['username'] = $_POST['username'];
  header('Location: index.php');
  exit;
}

if (isset($_GET['code'])) {
  session_start();
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  if(isset($token['error'])){
    error_log('Error during token retrieval: ' . $token['error']);
    header('Location: login.php');
    exit;
  }
  $_SESSION['token'] = $token;
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Login</title>
</head>
<body data-bs-theme="dark">
  <div class="container">
    <div class="row align-items-center vh-100">
      <div class="col-4">
        <div class="row">
          <div class="col">
            <div class="mb-4">
              <h2>Login</h2>
            </div>
            <form action="" method="post">
              <div class="mb-3">
                <label for="fullname" class="form-label">Fullname</label>
                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter your full name" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
              </div>
              <button type="submit" name="submit" class="btn btn-light w-100 mt-4">Login</button>
            </form>
            <div class="divider text-center m-4">
              <p>Atau</p>
            </div>
            <a type="button" class="btn btn-light d-block" href="<?= $client->createAuthUrl() ?>"><img src="img/google.png" width="30" alt="Google Logo"> Login with Google</a>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="row justify-content-center">
          <div class="col-8">
            <img src="img/computer.svg" alt="computer svg">
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>