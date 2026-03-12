<?php
session_start();
require 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('imong client id');
$client->setClientSecret('imong secret key');
$client->setRedirectUri('http://localhost/login_auth/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $_SESSION['email'] = $google_account_info->email;
        $_SESSION['name'] = $google_account_info->name;
        header('Location: welcome.php');
        exit();
    } else {
        $error = $token['error'] ?? 'Unknown';
        $desc = $token['error_description'] ?? '';
        echo "Error logging in with Google.<br>Error: " . htmlspecialchars($error);
        if ($desc) echo "<br>Details: " . htmlspecialchars($desc);
    }
} else {
    header('Location: index.php');
    exit();
}
