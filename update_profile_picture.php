<?php
session_start();
include 'includes/db.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $username = $_SESSION['username'];
    $file = $_FILES['profile_picture'];

    // Validate file
    if ($file['error'] == UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = 'uploads/';
            $fileName = $username . '.' . $fileExtension;
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $updateSql = "UPDATE users SET profile_picture = '$fileName' WHERE username = '$username'";
                if ($conn->query($updateSql) === TRUE) {
                    $response['status'] = 'success';
                    $response['message'] = 'Profile picture updated successfully.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Error updating profile picture in database.';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error uploading file.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid file type.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'File upload error.';
    }

    echo json_encode($response);
    $conn->close();
}
?>
