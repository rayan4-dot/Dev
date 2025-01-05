<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
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
            <a href="user.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Users</a>
          </li>
          <li>
            <a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a>
          </li>
          <li>
            <a href="tag.php" class="block px-4 py-2 hover:bg-blue-700 ">Tag</a>
          </li>
          <li>
            <a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Article</a>
          </li>
        </ul>
      </nav>
      <div class="p-4">
        <button class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
      </div>
      <div class="p-4 text-sm text-center">&copy; 2025 Dashboard</div>
    </aside>

    <!-- Main Content -->
    <!-- <main class="flex-1 p-6">
      <div class="bg-white shadow-md rounded-lg p-4">
        <h1 class="text-2xl font-semibold mb-4">User Management</h1>
        <div class="flex justify-between items-center mb-4">
          <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Add User
          </button>
          <input
            type="text"
            placeholder="Search users..."
            class="border border-gray-300 rounded px-4 py-2"
          />
        </div> -->
        <!-- <table class="w-full border border-gray-300 bg-white rounded shadow-md">
          <thead class="bg-gray-100">
            <tr>
              <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
              <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            Example User -->
            <!-- <tr>
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">John Doe</td>
              <td class="border border-gray-300 px-4 py-2">john@example.com</td>
              <td class="border border-gray-300 px-4 py-2">Admin</td>
              <td class="border border-gray-300 px-4 py-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
              </td>
            </tr>
          </tbody>
        </table> --> 
      </div>
    </main>
  </div>
</body>
</html>
