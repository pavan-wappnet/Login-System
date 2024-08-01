<?php

include 'includes/db.php';
include 'user.php';

$response = [];
$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $profilePicture = $_FILES['profile_picture'];

    $registerResponse = $user->register($username, $password, $email, $profilePicture);
    $response['status'] = $registerResponse['status'];
    $response['message'] = $registerResponse['message'];

    echo json_encode($response);
    $conn->close();
}
?>
