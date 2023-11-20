<?php
session_start();

if(!isset($_SESSION['token']) && !isset($_SESSION['username'])){
  header('Location: login.php');
  exit;
}

if(isset($_SESSION['token'])) {
  require('config.php');
  $client = new Google\Client();
  $client->setAccessToken($_SESSION['token']);
  $client->revokeToken();
}

$_SESSION = array();

session_destroy();
header("Location: login.php");
exit;