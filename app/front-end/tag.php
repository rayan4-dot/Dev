<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../class/tags/Tag.php'; 
require_once '../handler/t.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Article Tags Dashboard</title>
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
        <li><a href="user.php" class="block px-4 py-2 hover:bg-blue-700">Users</a></li>
          <li><a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a></li>
          <li><a href="tag.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Tag</a></li>
          <li><a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Article</a></li>
        </ul>
      </nav>
      <form action="" method="POST">
        <button type="submit" name="logout" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
      </form>
      <div class="p-4 text-sm text-center">&copy; 2025 Dev-Blog</div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <div class="bg-white shadow-md rounded-lg p-4">
        <h1 class="text-2xl font-semibold mb-4">Manage Tags</h1>

        <!-- Add Tag and Search Bar -->
        <div class="flex justify-between items-center mb-4">
          <form action="tag.php" method="POST">
            <input type="text" name="nameTag" placeholder="Enter tag name..." class="border border-gray-300 rounded px-4 py-2" required />
            <button type="submit" name="add_tag" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
              Add Tag
            </button>
          </form>
          <input type="text" placeholder="Search tags..." class="border border-gray-300 rounded px-4 py-2" />
        </div>

        <!-- Tags Table -->
        <table class="w-full border border-gray-300 bg-white rounded shadow-md">
          <thead class="bg-gray-100">
            <tr>
              <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Tag Name</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tags as $tagItem): ?>
              <tr>
                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($tagItem['id']); ?></td>
                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($tagItem['name']); ?></td>
                <td class="border border-gray-300 px-4 py-2">
                  <a href="updateTag.php?id=<?php echo htmlspecialchars($tagItem['id']); ?>">
                    <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                  </a>
                  <a href="tag.php?delete_id=<?php echo htmlspecialchars($tagItem['id']); ?>" onclick="return confirm('Are you sure you want to delete this tag?');">
                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>
