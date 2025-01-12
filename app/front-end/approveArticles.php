<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

$db = new Database();
$conn = $db->getConnection();


$sql = "SELECT * FROM articles WHERE status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pendingArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animations */
        .hover-scale:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease-in-out;
        }

        .hover-button:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Main container -->
    <div class="container mx-auto p-6 max-w-4xl">

        <!-- Heading -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Pending Articles</h1>

        <!-- Article List -->
        <div class="space-y-4">
            <?php foreach ($pendingArticles as $article): ?>
            <div
                class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between hover-scale hover-shadow transition-all duration-300 ease-in-out transform">
                <!-- Article Title -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($article['title']) ?></h2>
                </div>

                <!-- Approve and Disapprove Buttons -->
                <div class="flex space-x-4">
                    <!-- Approve Button -->
                    <a href="approve_article.php?id=<?= $article['id'] ?>"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transform hover:scale-105 transition duration-300">
                        Approve
                    </a>

                    <!-- Disapprove Button -->
                    <a href="disapprove_article.php?id=<?= $article['id'] ?>"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transform hover:scale-105 transition duration-300">
                        Disapprove
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>
