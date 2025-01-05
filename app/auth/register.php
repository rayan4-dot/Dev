<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Password hashing
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Get the database connection
        $conn = Database::con();

        if ($conn) {
            // Check if username or email already exists in the database
            $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $error_message = "Le nom d'utilisateur ou l'email est déjà pris.";
            } else {
                // Insert user data into the users table
                $sql = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password_hash', $password_hash);

                if ($stmt->execute()) {
                    $success_message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                } else {
                    $error_message = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
    } catch (PDOException $e) {
        $error_message = "Erreur de connexion à la base de données: " . $e->getMessage();
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
        <h2 class="text-2xl font-bold text-center mb-6">S'inscrire</h2>

        <?php if (isset($error_message)): ?>
            <div class="bg-red-500 text-white text-center p-2 mb-4 rounded">
                <?php echo $error_message; ?>
            </div>
        <?php elseif (isset($success_message)): ?>
            <div class="bg-green-500 text-white text-center p-2 mb-4 rounded">
                <?php echo $success_message; ?>
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

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">S'inscrire</button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">Déjà un compte ? <a href="login.php" class="text-blue-500 hover:underline">Se connecter</a></p>
    </div>
</body>
</html>
