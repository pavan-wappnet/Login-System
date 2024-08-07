<?php

session_start();
include 'includes/db.php';
include 'user.php';

$response = [];
$user = new User($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $resetCode = $_POST['resetCode'];
    $newPassword = $_POST['newPassword'];

    $response = $user->resetPasswordWithCode($username, $resetCode, $newPassword);

    if ($response['success']) {
        $_SESSION['resetCode'] = $resetCode;
        $response['message'] = 'Password reset successful. Please log in with your new password.';

    } else {
        $response['message'] = 'Invalid reset code. Please try again.';
    }

    echo json_encode($response);
    $conn->close();
}

?>