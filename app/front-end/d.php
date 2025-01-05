  <?php
  session_start(); // Start the session

  // Check if the user is logged in
  if (!isset($_SESSION['username'])) {
      // Redirect to login if not logged in
      header("Location: login.php");
      exit;
  }

  $username = $_SESSION['username']; // Get the username from the session
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 h-screen">
    <div class="flex h-full">
      <!-- Sidebar -->
      <aside class="w-64 bg-blue-900 text-white flex flex-col">
        <div class="p-4 text-xl font-bold">Admin</div>
        <nav class="flex-1">
          <ul class="space-y-2">
            <li><a href="d.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Home</a></li>
            <li><a href="user.php" class="block px-4 py-2 hover:bg-blue-700">Users</a></li>
            <li><a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a></li>
            <li><a href="tag.php" class="block px-4 py-2 hover:bg-blue-700 ">Tag</a></li>
            <li><a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Article</a></li>
          </ul>
        </nav>
        <div class="p-4">
        <form action="d.php" method="POST">
      <button type="submit" name="logout" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
  </form>

        </div>
        <div class="p-4 text-sm text-center">&copy; 2025 Dev-Blog</div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6">
        <div class="bg-white shadow-md rounded-lg p-4">
          <h2 class="text-2xl font-bold">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        </div>
      </main>
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
