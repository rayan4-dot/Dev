<?php

require_once '../../config/database.php'; 
require_once '../../class/tags/Tag.php'; 


$database = new Database();
$db = $database->getConnecion();


$tag = new Tag($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_tag'])) {
    $tag->id = $_POST['id']; 
    $tag->name = $_POST['name'];


    if ($tag->update()) {
        echo "<script>alert('Tag updated successfully!'); window.location.href='../tag.php';</script>";
    } else {
        echo "<script>alert('Failed to update tag.');</script>";
    }
}


if (isset($_GET['id'])) {
    $tag->id = $_GET['id']; 
    $tagDetails = $tag->update(); 


    if (!$tagDetails) {
        echo "<script>alert('Tag not found!'); window.location.href='../tag.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Tag</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen">
  <div class="flex h-full">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col">
      <div class="p-4 text-xl font-bold">Admin</div>
      <nav class="flex-1">
        <ul class="space-y-2">
          <li><a href="d.php" class="block px-4 py-2 hover:bg-blue-700">Home</a></li>
          <li><a href="user.php" class="block px-4 py-2 hover:bg-blue-700">Users</a></li>
          <li><a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a></li>
          <li><a href="tag.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Tag</a></li>
          <li><a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Article</a></li>
        </ul>
      </nav>
      <form action="d.php" method="POST">
        <button type="submit" name="logout" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
      </form>
      <div class="p-4 text-sm text-center">&copy; 2025 Dev-Blog</div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <div class="bg-white shadow-md rounded-lg p-4">
        <h1 class="text-2xl font-semibold mb-4">Update Tag</h1>

        <!-- Update Tag Form -->
        <form action="update.php" method="POST" class="space-y-4">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($tag->id); ?>" />

          <div>
            <label for="name" class="block text-sm font-medium">Tag Name</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($tagDetails['name']); ?>" class="border border-gray-300 rounded px-4 py-2 w-full" required />
          </div>

          <button type="submit" name="update_tag" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Update Tag</button>
        </form>
      </div>
    </main>
  </div>
</body>

</html>
