<?php
session_start();
include 'includes/db.php';
include 'user.php';

$response = [];
$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $changePasswordResponse = $user->changePassword($username, $currentPassword, $newPassword, $confirmPassword);
    $response['status'] = $changePasswordResponse['status'];
    $response['message'] = $changePasswordResponse['message'];

    echo json_encode($response);
    $conn->close();
}
?>
