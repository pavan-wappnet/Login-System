<?php
include 'includes/db.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }
}
?>