<?php


require_once 'vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('YOUR_CLIENT_ID');

$google_client->setClientSecret('YOUR_CLIENT_SECRET');

$google_client->setRedirectUri('YOUR_CALLBACK_URL');

$google_client->addScope('email');

$google_client->addScope('profile');

$auth_url = $google_client->createAuthUrl();

session_start();
?>