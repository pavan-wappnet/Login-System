<?php
session_start();

include 'includes/db.php'; // Ensure this file sets up $conn correctly
include 'user.php';

$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    $token = $user->generateResetToken($username);

    if ($token) {
        $_SESSION['username'] = $username;
        $response = [
            'status' => 'success',
            'token' => $token
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Could not generate reset token.'
        ];
    }

    echo json_encode($response);
    $conn->close();
}

?>
