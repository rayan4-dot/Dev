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
<body class="bg-gray-100 h-screen">
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-semibold mb-6">Published Articles</h1>

        <?php if (count($articles) > 0): ?>
            <ul class="space-y-4">
                <?php foreach ($articles as $articleItem): ?>
                    <li class="bg-white p-4 rounded shadow-md ">
                        <h2 class="text-xl font-bold"><?= htmlspecialchars($articleItem['title']) ?></h2>
        <a href="articleDetail.php?id=<?= $articleItem['id'] ?>" class="text-blue-600">Read more</a>
        <a href="updateArticle.php?id=<?= $articleItem['id'] ?>" class="text-blue-600">Edit</a>
        <a href="deleteArticle.php?id=<?= $articleItem['id'] ?>" class="text-red-600" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </div>
    <a href="articleU.php"><button class=" bg-red-600 text-white px-6 py-2 rounded">Back</button>
</a>
</body>
</html>
