<?php
session_start();
include 'includes/db.php';

session_unset();
session_destroy();

setcookie('rememberMe', '', time() - 3600, '/', '', false, true);

header("Location: index.html");
?>

