<?php
session_start();
include 'includes/db.php';
include 'user.php';

$user = new User($conn);

if(!isset($_SESSION['username']) && isset($_COOKIE['rememberMe'])) {
    $token = $_COOKIE['rememberMe'];
    $userDetails = $user->verifyRememberMeToken($token);

    if($userDetails) {
        $_SESSION['username'] = $userDetails['username'];
    } else {
        setcookie('rememberMe', '', time() - 3600, '/', '', false, true);
    }
}
?>
