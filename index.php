<?php
session_start();
require 'vendor/autoload.php';

if (isset($_SESSION['email'])) {
    header("Location: welcome.php");
    exit();
}

$client = new Google_Client();
$client->setClientId('imong client id');
$client->setClientSecret('imong secret key');
$client->setRedirectUri('http://localhost/login_auth/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html>
<head><title>Login with Google</title></head>
<body>
<h2>Login with Google</h2>
<a href="<?php echo htmlspecialchars($login_url); ?>">
    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Sign in with Google">
</a>
</body>
</html>
