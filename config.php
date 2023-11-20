<?php 
require('./vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv -> load();

$client = new Google\Client();

$client->setClientId($_ENV["CLIENT_ID"]);
$client->setClientSecret($_ENV["CLIENT_SECRET"]);

$redirect_uri = 'http://localhost/basdat-project-oauth/login.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("profile");
$client->addScope("email");
?>