<?php

// ini_set('display_errors', 1);

// error_reporting(E_ALL);

// use App\Config\Database;

// require_once __DIR__ . '/../../config/database.php';

// require_once __DIR__ . '/../tags/Tag.php';
// require_once __DIR__ . '/../category/category.php';
// require_once __DIR__ . '/article.php';

// $database = new Database();
// $db = $database->getConnection();

// $category = new Category($db);
// $categories = $category->readAll();

// $tag = new Tag($db);
// $tags = $tag->display();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $title = $_POST['title'];
//     $slug = $_POST['slug'];
//     $content = $_POST['content'];
//     $category_id = $_POST['category'];
//     $tags = isset($_POST['tags']) ? $_POST['tags'] : []; 


?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Article</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <aside class="w-64 bg-blue-900 text-white">
      <div class="p-4 text-xl font-bold">User Panel</div>
      <nav>
        <ul>
          <li><a href="../userView/articleU.php" class="block px-4 py-2 hover:bg-blue-700">Articles</a></li>
        </ul>
      </nav>
    </aside>
    <main class="flex-1 p-6">
      <div class="bg-white p-4 shadow-md rounded">
        <h1 class="text-2xl font-semibold mb-4">Add Article</h1>
        <form method="POST" action="">
          <div class="mb-4">
            <label class="block text-sm font-semibold">Title</label>
            <input type="text" name="title" class="border rounded w-full px-4 py-2" required>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-semibold">Slug</label>
            <input type="text" name="slug" class="border rounded w-full px-4 py-2" required>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-semibold">Content</label>
            <textarea name="content" class="border rounded w-full px-4 py-2" rows="5" required></textarea>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-semibold">Category</label>
            <select name="category" class="border rounded w-full px-4 py-2" required>
              <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-semibold">Tags</label>
            <select name="tags[]" multiple class="border rounded w-full px-4 py-2">
              <?php foreach ($tags as $tag): ?>
                <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Article</button>

          <a href="../userView/articleU.php">    
          <button class="bg-red-600 text-white px-4 py-2 rounded">Back</button>


        </form>
      </div>
    </main>
  </div>
</body>
</html> -->
