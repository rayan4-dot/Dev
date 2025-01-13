<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Config\Database;
require_once __DIR__ . '/../class/article/article.php';

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Article\Article;

$article = new Article();   


$articles = $article->getAllArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 font-sans">
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-4xl font-bold text-gradient bg-clip-text text-transparent mb-8 text-center">
            Published Articles
        </h1>

        <?php if (count($articles) > 0): ?>
            <ul class="space-y-8">
                <?php foreach ($articles as $articleItem): ?>
                    <li class="bg-white p-6 rounded-xl shadow-2xl transform transition-all hover:scale-105 hover:shadow-2xl hover:bg-gradient-to-r hover:from-blue-500 hover:to-teal-400 hover:text-white duration-300">
                        <h2 class="text-2xl font-semibold text-gray-900"><?= htmlspecialchars($articleItem['title']) ?></h2>
                        <div class="mt-4 text-gray-700">
                            <a href="articleDetail.php?id=<?= $articleItem['id'] ?>" class="text-blue-600 hover:text-blue-800 transition-all duration-200 ease-in-out">Read more</a>
                            <span class="mx-2 text-gray-400">|</span>
                            <a href="updateArticle.php?id=<?= $articleItem['id'] ?>" class="text-green-600 hover:text-green-800 transition-all duration-200 ease-in-out">Edit</a>
                            <span class="mx-2 text-gray-400">|</span>
                            <a href="deleteArticle.php?id=<?= $articleItem['id'] ?>" class="text-red-600 hover:text-red-800 transition-all duration-200 ease-in-out" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-600 text-center">No articles found.</p>
        <?php endif; ?>
    </div>

    <div class="fixed bottom-6 right-6">
        <a href="../front-end/user.php">
            <button class="bg-gradient-to-r from-red-600 to-pink-600 text-white py-2 px-6 rounded-full shadow-xl hover:from-red-500 hover:to-pink-500 transform transition-all duration-300 ease-in-out hover:scale-105">
                Back
            </button>
        </a>
    </div>
</body>
</html>
