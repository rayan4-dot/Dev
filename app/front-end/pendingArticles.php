<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Class\Article\Article;

$article = new Article();


$pendingArticles = $article->getPendingArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Articles</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.2/tailwind.min.css">
</head>
<body class="bg-gray-100 font-roboto">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold mb-4">Pending Articles</h1>

        <?php if (!empty($pendingArticles)): ?>
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Category</th>
                        <th class="py-3 px-4 text-left">Author</th>
                        <th class="py-3 px-4 text-left">Created At</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingArticles as $article): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4"><?= htmlspecialchars($article['title']) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($article['category_name']) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($article['author_name']) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($article['created_at']) ?></td>
                            <td class="py-3 px-4">
                                <a href="approve_article.php?id=<?= $article['id'] ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Approve</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-lg text-gray-500">No pending articles at the moment.</p>
        <?php endif; ?>

    </div>

</body>
</html>
