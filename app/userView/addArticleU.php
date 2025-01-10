<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Config\Database;
require_once __DIR__ . '/../class/article/article.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Article\Article;

$article = new Article();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-article'])) {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];
    $scheduled_date = $_POST['scheduled_date'];
    $author_id = $_SESSION['user_id'];  


    $article = new Article();
    if ($article->insertArticle($title, $slug, $content, $category_id, $status, $scheduled_date, $author_id)) {
        header("Location: articleU.php"); 
        exit();
    } else {
        echo "Failed to add the article.";
    }
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
    <title>Add New Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-semibold mb-6">Add New Article</h1>
        <form action="addArticleU.php" method="POST" class="space-y-6">
            <div>
                <label for="title" class="block">Title</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded" required>
            </div>

            <div>
                <label for="slug" class="block">Slug</label>
                <input type="text" name="slug" id="slug" class="w-full px-4 py-2 border rounded" required>
            </div>

            <div>
                <label for="content" class="block">Content</label>
                <textarea name="content" id="content" class="w-full px-4 py-2 border rounded" rows="6" required></textarea>
            </div>

            <div>
                <label for="category_id" class="block">Category</label>
                        <select name="category_id" required>
        <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                         <?php } ?>
    </select>
            </div>

            <div>
                <label for="status" class="block">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border rounded" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <div>
                <label for="scheduled_date" class="block">Scheduled Date</label>
                <input type="datetime-local" name="scheduled_date" id="scheduled_date" class="w-full px-4 py-2 border rounded">
            </div>

            <div>
                <button type="submit" name="add-article" class="bg-blue-600 text-white px-6 py-2 rounded">Add Article</button>


            </div>

        </form>
        <a href="articleU.php">                     <button class=" bg-red-600 text-white px-6 py-2 rounded">Back</button>

                </a>
    </div>
</body>
</html>
