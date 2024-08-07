<?php
session_start();
include 'includes/db.php';
include 'check_remember_me.php';


// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Fetch user data
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

        <!-- Password Change Form -->
        <h3>Change Password</h3>
        <form id="changePasswordForm" method="POST" action="change_password.php">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" required>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>

            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit">Change Password</button>
        </form>
        <p id="passwordMessage"></p>

        <!-- Profile Picture Update Form -->
        <h3>Update Profile Picture</h3>
        <form id="updateProfilePicForm" method="POST" enctype="multipart/form-data" action="update_profile_picture.php">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>

            <button type="submit">Upload Picture</button>
        </form>
        <p id="profilePicMessage"></p>

        <p><a href="dashboard.php">Dashboard</a></p>
        <p><a href="logout.php">Logout</a></p>


    </div>
</body>

</html>