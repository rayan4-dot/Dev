<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../class/article/article.php';
require_once '../handler/a.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Article Management Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
  <div class="flex h-full">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col">
      <div class="p-4 text-xl font-bold">Admin</div>
      <nav class="flex-1">
        <ul class="space-y-2">
          <li><a href="dashboard.php" class="block px-4 py-2 hover:bg-blue-700">Home</a></li>
          <li><a href="userTrack.php" class="block px-4 py-2 hover:bg-blue-700">Users</a></li>
          <li><a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a></li>
          <li><a href="tag.php" class="block px-4 py-2 hover:bg-blue-700">Tag</a></li>
          <li><a href="article.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Pending Articles</a></li>
        </ul>
      </nav>
      <div class="p-4">
        <a href="logout.php">
          <button class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
        </a>
      </div>
      <div class="p-4 text-sm text-center">&copy; 2025 Dev-Blog</div>
    </aside>


    <main class="flex-1 p-6">
      <div class="bg-white shadow-md rounded-lg p-4">
        <h1 class="text-2xl font-semibold mb-4">Manage Articles</h1>
        <div class="flex justify-between items-center mb-4">
          <a href="../front-end/addArticle.php">
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Article</button>
          </a>
          <input type="text" placeholder="Search articles..." class="border border-gray-300 rounded px-4 py-2" />
        </div>



          <table class="w-full border border-gray-300 bg-white rounded shadow-md">
            <thead class="bg-gray-100">
              <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Tags</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
              </tr>
            </thead>
            <tbody> 

            <tbody>
  <?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
      <tr>
        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['id']); ?></td>
        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['title']); ?></td>
        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['category_name']); ?></td>
        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['tags']); ?></td>
        <td class="border border-gray-300 px-4 py-2">
          <a href="../class/article/edit.php?id=<?php echo htmlspecialchars($article['id']); ?>">
            <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
          </a>
          <form action="" method="post" style="display: inline;">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>">
            <button type="submit" onclick="return confirm('Are you sure you want to delete this article?');" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</tbody>

          </table>
      </div>
    </main>
  </div>

</body>
</html>
