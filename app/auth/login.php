<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {

        $conn = Database::con();

        if ($conn) {
            // check if the user exists
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {

                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];


                header("Location: ../front-end/d.php");
                exit;
            } else {
                $error_message = "Email ou mot de passe incorrect.";
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
    <title>Se connecter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Se connecter</h2>

        <?php if (isset($error_message)): ?>
            <div class="bg-red-500 text-white text-center p-2 mb-4 rounded">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Se connecter</button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">Pas encore de compte ? <a href="register.php" class="text-blue-500 hover:underline">S'inscrire</a></p>
    </div>
</body>
</html>
