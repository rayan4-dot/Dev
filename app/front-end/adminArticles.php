<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Config\Database;
require_once __DIR__ . '/../class/article/article.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Article\Article;

$article = new Article();   
$articles = $article->getAllArticlesForAdmin(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Keyframes for Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-gray-50 to-gray-200 min-h-screen">
    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8 fade-in-up">Admin - Manage Articles</h1>

        <?php if (count($articles) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($articles as $articleItem): ?>
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 fade-in-up transform hover:-translate-y-2">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($articleItem['title']) ?></h2>
                        <p class="text-gray-600 mb-4">
                            <?= htmlspecialchars(substr($articleItem['content'], 0, 100)) ?>
                        </p>
                        <p class="text-gray-500 text-sm mb-4">Status: <?= htmlspecialchars($articleItem['status']) ?></p>
                        <div class="flex justify-between items-center">
                        <a href="../userView/articleDetail.php?id=<?= $articleItem['id'] ?>" 
   class="text-blue-600 font-semibold hover:text-blue-800 transition-colors duration-300">Read More</a>
                                
                            <div class="space-x-4">
                                <a href="deleteArticle.php?id=<?= $articleItem['id'] ?>" 
                                   class="text-red-600 font-semibold hover:text-red-800 transition-colors duration-300" 
                                   onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-700 text-lg fade-in-up">No articles found.</p>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
    <p class="text-center text-green-600 font-semibold fade-in-up">Article deleted successfully.</p>
<?php elseif (isset($_GET['error'])): ?>
    <p class="text-center text-red-600 font-semibold fade-in-up">Failed to delete the article. Please try again.</p>
<?php endif; ?>

        <div class="mt-8 text-center fade-in-up">
            <a href="../front-end/dashboard.php" 
               class="inline-block bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transform hover:scale-105 transition-transform duration-300">
                Back
            </a>
        </div>
    </div>
</body>
</html>
