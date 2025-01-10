<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


require_once __DIR__ . '/../config/database.php';

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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-4 text-xl font-bold">User Panel</div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li><a href="../userView/addArticleU.php" class="block px-4 py-2 hover:bg-blue-700">Add Article</a></li>
                    <li><a href="../userView/articleU.php" class="block px-4 py-2 hover:bg-blue-700">View Articles</a></li>
                </ul>
            </nav>
            <div class="mt-8 text-center">
                    <a href="../auth/logout.php" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Logout</a>
                </div>
            <div class="p-4 text-sm text-center">&copy; <span id="year"></span> Dev-Blog</div>
        </aside>

        <main class="flex-1 p-6 bg-gray-50">
            <div class="bg-white shadow-xl rounded-lg p-8 mb-6 max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-blue-900 mb-8">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

                <?php if (isset($userData)): ?>
                    <div class="flex justify-center items-center flex-col">
                        <img src="<?php echo htmlspecialchars($userData['profile_picture_url']); ?>" alt="Profile Picture" class="w-36 h-36 rounded-full border-4 border-blue-600 mb-6 shadow-lg">
                        <div class="w-full max-w-md text-center">
                            <p class="text-lg text-gray-700"><?php echo htmlspecialchars($userData['bio']); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center text-gray-500 mt-4">
                        <p>No profile data available. Please update your bio and profile picture.</p>
                    </div>
                <?php endif; ?>

                <!-- Logout button -->


            </div>
        </main>
    </div>

    <script>
        // set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>
