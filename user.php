<?php

class User {
    public $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password, $email, $profilePicture) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return ['status' => 'error', 'message' => 'Username or email already exists.'];
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $targetDir = "uploads/";
        $fileName = basename($profilePicture['name']);
        $targetFile = $targetDir . basename($profilePicture["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        $check = getimagesize($profilePicture["tmp_name"]);
        if ($check === false) {
            return ['status' => 'error', 'message' => 'File is not an image.'];
        }

        if ($profilePicture["size"] > 5000000) {
            return ['status' => 'error', 'message' => 'Sorry, your file is too large.'];
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            return ['status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.'];
        }

        if (!move_uploaded_file($profilePicture["tmp_name"], $targetFile)) {
            return ['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.'];
        }

        $stmt = $this->conn->prepare("INSERT INTO users (username, password, email, profile_picture) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $passwordHash, $email, $fileName);
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'User registered successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Error registering user.'];
        }
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            return ['status' => 'error', 'message' => 'Invalid username or password.'];
        }

        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return ['status' => 'success', 'message' => 'Login successful.'];
        } else {
            return ['status' => 'error', 'message' => 'Invalid username or password.'];
        }
    }

    public function changePassword($username, $currentPassword, $newPassword, $confirmPassword) {
        if ($newPassword === $currentPassword) {
            return ['status' => 'error', 'message' => 'New Password cannot be same as current password.'];
        } 
        
        if ($newPassword !== $confirmPassword) {
            return ['status' => 'error', 'message' => 'New Password do not match.'];
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if(password_verify($currentPassword, $user['password'])) {
                $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                $updateSql = $this->conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $updateSql->bind_param("ss", $newPasswordHash, $username);
                if($updateSql->execute()){
                    return ['status'=>'success', 'message' => 'Password updated successfully.'];
                } else {
                    return ['status'=>'success', 'message' => 'Error updating passwoord'];
                }        
            } else {
                return ['status' => 'error', 'message' => 'Current password is incorrect.'];
        
            }
        }        
    }

    public function updateProfilePicture($username, $profilePicture) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $targetDir = "uploads/";
        $fileName = basename($profilePicture['name']);
        $targetFile = $targetDir . basename($profilePicture["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        $check = getimagesize($profilePicture["tmp_name"]);
        if ($check === false) {
            return ['status' => 'error', 'message' => 'File is not an image.'];
        }

        if ($profilePicture["size"] > 5000000) {
            return ['status' => 'error', 'message' => 'Sorry, your file is too large.'];
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            return ['status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.'];
        }

        if (!move_uploaded_file($profilePicture["tmp_name"], $targetFile)) {
            return ['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.'];
        }

        $updateSql = $this->conn->prepare("UPDATE users SET profile_picture = ? WHERE username = ?");
        $updateSql->bind_param("ss", $fileName, $username);
        if($updateSql->execute()){
            return ['status'=>'success', 'message' => 'Profile picture updated successfully.'];
        } else {
            return ['status'=>'success', 'message' => 'Error updating profile picture'];
        }
    }
}

?>