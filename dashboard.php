<?php
session_start();
include 'check_remember_me.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

include 'includes/db.php';

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $user['username']; ?>!</h2>
        <p>Email: <?php echo $user['email']; ?></p>
        <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="100">
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>

        <a href="update_profile.php" class="update_profile">Update Profile</a>
    </div>
</body>
</html>
