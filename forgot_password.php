<?php
session_start();
include 'includes/db.php';
include 'user.php';

$response = [];
$user = new User($conn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $fp_response = $user->generateResetCode($username);

    if($fp_response['status'] === 'success') {
        $_SESSION['username'] = $username;
        $response['status'] = 'success';
        $response['message'] = 'Reset code sent to your email.';
    } else {
        $response['status'] = 'error';
        $response['message'] = $fp_response['message'];
    }

    echo json_encode($response);
    $conn->close();
}

?>