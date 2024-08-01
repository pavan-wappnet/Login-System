<?php 
session_start();
include 'includes/db.php';
include 'user.php';

$response = [];
$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $loginResponse = $user->login($username, $password);
    if($loginResponse['status'] === 'success') {
        $_SESSION['username'] = $username;
        $response['status'] = 'success';
        $response['message'] = 'Login successful';
    } else {
        $response['status'] = 'error';
        $response['message'] = $loginResponse['message'];
    }

    echo json_encode($response);
    $conn->close();

}
?>
