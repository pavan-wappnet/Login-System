<?php
session_start();
include 'includes/db.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if($newPassword === $currentPassword && $confirmPassword === $currentPassword ){
        $response['status'] = 'error';
        $response['message'] = 'New password cannot be same as current password.';
    } elseif ($newPassword !== $confirmPassword) {
        $response['status'] = 'error';
        $response['message'] = 'New passwords do not match.';
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        if (password_verify($currentPassword, $user['password'])) {
            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateSql = "UPDATE users SET password = '$newPasswordHash' WHERE username = '$username'";
            if ($conn->query($updateSql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'Password updated successfully.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error updating password.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Current password is incorrect.';
        }
    }

    echo json_encode($response);
    $conn->close();
}
?>
