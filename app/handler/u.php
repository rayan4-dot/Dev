<?php

$username = $_SESSION['username'];
use App\Config\Database;

$db = new Database();
$conn = $db->getConnection();  

if (!$conn) {
    die("Database connection failed.");
}

$sql = "SELECT username, bio, profile_picture_url FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
    $error_message = "User not found.";
}
