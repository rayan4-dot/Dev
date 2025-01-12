<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if (!isset($_SESSION['username'])) {
    die("You must be logged in to update your profile.");
}
use App\Config\Database;


$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $newUsername = $_POST['username'];
    $bio = $_POST['bio'];
    $profilePictureUrl = $_POST['profile_picture_url'];  


    $db = new Database();
    $conn = $db->getConnection();

    $sql = "UPDATE users SET username = :username, bio = :bio, profile_picture_url = :profile_picture_url WHERE username = :current_username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $newUsername);
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':profile_picture_url', $profilePictureUrl);
    $stmt->bindParam(':current_username', $username);

    if ($stmt->execute()) {

        $_SESSION['username'] = $newUsername;
        header("Location: ../front-end/user.php");  
        exit();
    } else {
        $error_message = "There was an error updating your profile.";
    }
}
?>
