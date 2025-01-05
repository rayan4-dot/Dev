<?php
require_once __DIR__."/../handler/tag.php";

taghandler::addTag();
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
          <li>
            <a href="d.php" class="block px-4 py-2 hover:bg-blue-700">Home</a>
          </li>
          <li>
            <a href="user.php" class="block px-4 py-2 hover:bg-blue-700">Users</a>
          </li>
          <li>
            <a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a>
          </li>
          <li>
            <a href="tag.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Tag</a>
          </li>
          <li>
            <a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Article</a>
          </li>
        </ul>
      </nav>
      <form action="d.php" method="POST">
    <button type="submit" name="logout" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
</form>
<div class="p-4 text-sm text-center">&copy; 2025 Dev-Blog</div>
</aside>

    <!-- Main Content -->
    <!-- <main class="flex-1 p-6">
      <div class="bg-white shadow-md rounded-lg p-4">
        <h1 class="text-2xl font-semibold mb-4">Manage Article Tags</h1>
        <div class="flex justify-between items-center mb-4">
          <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Add Tag
          </button>
          <input
            type="text"
            placeholder="Search tags..."
            class="border border-gray-300 rounded px-4 py-2"
          />
        </div>
        <table class="w-full border border-gray-300 bg-white rounded shadow-md">
          <thead class="bg-gray-100">
            <tr>
              <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Tag Name</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
             Example Tag -->
            <!-- <tr>
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">Technology</td>
              <td class="border border-gray-300 px-4 py-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div> -->
    <!-- </main> --> 
  </div>


  <?php
// Handle logout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    // Unset all session variables
    session_start(); // Make sure session is started before unsetting
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the login page
    header("Location: /Dev-Blog/app/auth/login.php"); 
    exit;
}
?>

</body>
</html>
