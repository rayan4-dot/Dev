<?php

require_once __DIR__ . '/../config/database.php';
use App\Config\Database;

class User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function isEmailOrUsernameTaken($username, $email)
    {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerUser($username, $email, $passwordHash, $bio, $profilePictureUrl)
    {
        $sql = "INSERT INTO users (username, email, password_hash, role, bio, profile_picture_url) 
                VALUES (:username, :email, :password_hash, :role, :bio, :profile_picture_url)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $passwordHash);
        $stmt->bindValue(':role', 'user');
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':profile_picture_url', $profilePictureUrl);
        return $stmt->execute();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $bio = $_POST['bio'] ?? ''; 
    $profilePictureUrl = $_POST['profile_picture_url'] ?? ''; 
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {

        $db = new Database();
        $conn = $db->getConnection();

        $user = new User($conn);

        if ($user->isEmailOrUsernameTaken($username, $email)) {
            $error_message = "Email or username already taken";
        } else {

            if ($user->registerUser($username, $email, $password_hash, $bio, $profilePictureUrl)) {
                $success_message = "Registered successfully";
            } else {
                $error_message = "Error, Try again.";
            }
        }
    } catch (PDOException $e) {
        $error_message = "Something went wrong connecting to database " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Registration Form</h2>

        <?php if ($error_message): ?>
            <div class="bg-red-500 text-white text-center p-2 mb-4 rounded">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php elseif ($success_message): ?>
            <div class="bg-green-500 text-white text-center p-2 mb-4 rounded">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" name="bio" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="profile_picture_url" class="block text-sm font-medium text-gray-700">Profile Picture URL (CDN)</label>
                <input type="text" id="profile_picture_url" name="profile_picture_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Register</button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">Already registered? <a href="login.php" class="text-blue-500 hover:underline">Log In</a></p>
    </div>
</body>
</html>
