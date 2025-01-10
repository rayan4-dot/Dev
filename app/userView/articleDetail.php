<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Config\Database;
use App\Class\Article\Article;

require_once __DIR__ . '/../class/article/article.php';
require_once __DIR__ . '/../../vendor/autoload.php';


    if (!isset($_GET['id'])) {
        die("Article ID is required.");
    }

$articleId = $_GET['id'];


$article = new Article();


$articleDetails = $article->getArticleById($articleId);


if (!$articleDetails) {
    die("Article not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($articleDetails['title']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="max-w-4xl mx-auto p-6">
        <!-- Article Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Article Title -->
            <div class="p-6">
                <h1 class="text-4xl font-extrabold mb-4 text-gray-800"><?= htmlspecialchars($articleDetails['title']) ?></h1>

                <!-- Article Meta Information -->
                <div class="mb-6 text-sm text-gray-600">
                    <p><strong>Category:</strong> <?= htmlspecialchars($articleDetails['category_name']) ?></p>
                    <p><strong>Author:</strong> <?= htmlspecialchars($articleDetails['author_name']) ?></p>
                    <p><strong>Published on:</strong> <?= htmlspecialchars($articleDetails['created_at']) ?></p>
                </div>


                <div class="mb-6">
                    <p class="text-gray-700 leading-relaxed ">
                        <?= nl2br(htmlspecialchars($articleDetails['content'])) ?>
                    </p>
                </div>

                <!-- Back Button -->
                <a href="articleU.php" class="inline-block text-blue-600 font-medium hover:underline">
                    ← Back to Articles
                </a>
            </div>
        </div>
    </div>
</body>
</html>
