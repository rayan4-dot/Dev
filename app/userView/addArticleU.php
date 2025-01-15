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
    $status = 'pending';  
    $scheduled_date = $_POST['scheduled_date'];
    $author_id = $_SESSION['user_id'];
    $tags = isset($_POST['tags']) ? $_POST['tags'] : [];  


    if ($article->insertArticle($title, $slug, $content, $category_id, $status, $scheduled_date, $author_id, $tags)) {
        header("Location: articleU.php"); 
        exit();
    } else {
        echo "<div class='text-red-500'>Failed to add the article. Please try again.</div>";
    }
}


$db = new Database();
$conn = $db->getConnection();
$sqlCategories = "SELECT id, name FROM categories";  
$stmtCategories = $conn->prepare($sqlCategories);
$stmtCategories->execute();
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);


$sqlTags = "SELECT id, name FROM tags";  
$stmtTags = $conn->prepare($sqlTags);
$stmtTags->execute();
$tags = $stmtTags->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Container for the main content -->
    <div class="container mx-auto p-6 max-w-3xl">

        <!-- Heading -->
        <h1 class="text-4xl font-semibold text-gray-800 mb-8 text-center">Add New Article</h1>

        <!-- Article Form -->
        <form action="addArticleU.php" method="POST" class="bg-white p-6 shadow-lg rounded-lg space-y-6">
            
            <!-- Title Input -->
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Slug Input -->
            <div>
                <label for="slug" class="block text-lg font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Content Input -->
            <div>
                <label for="content" class="block text-lg font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" required></textarea>
            </div>

            <!-- Category Dropdown -->
            <div>
                <label for="category_id" class="block text-lg font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags Checkboxes -->
            <div>
                <label for="tags" class="block text-lg font-medium text-gray-700">Tags</label>
                <div class="space-y-2">
                    <?php foreach ($tags as $tag): ?>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tags[]" value="<?= $tag['id']; ?>" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2"><?= $tag['name']; ?></span>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Status Field Removed (Handled in Backend) -->

            <!-- Scheduled Date Input -->
            <div>
                <label for="scheduled_date" class="block text-lg font-medium text-gray-700">Scheduled Date</label>
                <input type="datetime-local" name="scheduled_date" id="scheduled_date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" name="add-article" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">Add Article</button>
            </div>
        </form>

        <!-- Back Button -->
        <a href="articleU.php" class="block mt-4 text-center">
            <button class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 w-full">Back</button>
        </a>

    </div>

</body>
</html>
 