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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-article'])) {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];
    $scheduled_date = $_POST['scheduled_date'];


    $article->updateArticle($articleId, $title, $slug, $content, $category_id, $status, $scheduled_date);


    header("Location: articleU.php");
    exit();
}


$db = new Database();
$conn = $db->getConnection();
$sql = "SELECT id, name FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-semibold mb-6">Update Article</h1>
        <form action="" method="POST" class="space-y-6">
            <div>
                <label for="title" class="block">Title</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($articleDetails['title']) ?>" required>
            </div>

            <div>
                <label for="slug" class="block">Slug</label>
                <input type="text" name="slug" id="slug" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($articleDetails['slug']) ?>" required>
            </div>

            <div>
                <label for="content" class="block">Content</label>
                <textarea name="content" id="content" class="w-full px-4 py-2 border rounded" rows="6" required><?= htmlspecialchars($articleDetails['content']) ?></textarea>
            </div>

            <div>
                <label for="category_id" class="block">Category</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $articleDetails['category_id'] ? 'selected' : '' ?>>
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="status" class="block">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded" required>
                    <option value="draft" <?= $articleDetails['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= $articleDetails['status'] === 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>

            <div>
                <label for="scheduled_date" class="block">Scheduled Date</label>
                <input type="datetime-local" name="scheduled_date" id="scheduled_date" class="w-full px-4 py-2 border rounded" value="<?= $articleDetails['scheduled_date'] ?>">
            </div>

            <div>
                <button type="submit" name="update-article" class="bg-blue-600 text-white px-6 py-2 rounded">Update Article</button>
            </div>
        </form>
    </div>
</body>
</html>
