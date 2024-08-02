<?php
session_start();
include 'includes/db.php';
include 'user.php';

$response = [];
$user = new User($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $username = $_SESSION['username'];
    $profilePicture = $_FILES['profile_picture'];

    $changeProfilePicture = $user->updateProfilePicture($username, $profilePicture);
    $response ['status'] = $changeProfilePicture['success'];
    $response['message'] = $changeProfilePicture['message'];

    echo json_encode($response);
    $conn->close();
    
}
?>
