<?php 
session_start();
require('config.php');

if (!isset($_SESSION['token']) && !isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

if(isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
  if($client->isAccessTokenExpired()){
    header('Location: logout.php');
    exit;
  }
  
  $google_oauth = new Google_Service_Oauth2($client);
  $user_info = $google_oauth->userinfo->get();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Profile</title>
</head>
<body data-bs-theme="dark">
  <?php if(isset($_SESSION['token'])) : ?>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col py-3">
          <img class="rounded-circle border border-secondary p-1 mx-auto d-block" src="<?=$user_info['picture'];?>">
        </div>
      </div>
      <div class="row justify-content-center text-center">
        <div class="col">
          <p class="display-6"><?= $user_info['name']; ?></p>
          <p class=""><?= $user_info['email']; ?></p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-2">
          <a type="button" class="btn btn-light d-block" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  <?php endif ?>
  
  <?php if(isset($_SESSION['username'])) : ?>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col py-3">
          <img width="100" class="rounded-circle border border-secondary p-1 mx-auto d-block" src="img/profile.jpeg">
        </div>
      </div>
      <div class="row justify-content-center text-center">
        <div class="col">
          <p class="display-6"><?= $_SESSION['fullname']; ?></p>
          <p class=""><?= $_SESSION['username']; ?></p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-2">
          <a type="button" class="btn btn-light d-block" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  <?php endif ?>


  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>