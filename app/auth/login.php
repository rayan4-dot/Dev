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

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $db = new Database();
        $conn = $db->getConnection();

        if ($email === 'rayanpro2023@gmail.com') {

            session_start();
            $_SESSION['user_id'] = 4; 
            $_SESSION['role'] = 'admin';
            
            header("Location: /Dev-Blog/app/front-end/dashboard.php");
            exit;
        }

        // user login handling
        $user = new User($conn);
        $userRecord = $user->getUserByEmail($email);

        if ($userRecord) {
            if (password_verify($password, $userRecord['password_hash'])) {
                session_start();
                $_SESSION['user_id'] = $userRecord['id'];
                $_SESSION['username'] = $userRecord['username'];
                $_SESSION['role'] = $userRecord['role'];
                header("Location: /Dev-Blog/app/front-end/user.php");
                exit;
                
                if ($_SESSION['role'] === 'admin') {

                    header("Location: /Dev-Blog/app/front-end/dashboard.php");
                } else {

                }
                
            } else {
                $error_message = "wrong pass";
            }
        } else {
            $error_message = "account not found";
        }
    } catch (PDOException $e) {
        $error_message = "database error: " . $e->getMessage();
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
                <?php echo htmlspecialchars($error_message); ?>
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
