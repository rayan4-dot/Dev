<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;
use App\Class\Tags\Tag; 

$tagItem = new Tag();

$db = (new Database())->getConnection();


if(isset($_POST['update-tag']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];

    $name = $_POST['nameTag'];

    $tagItem->update(["name" => $name], $id);
    header("Location: tag.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit tag</title>
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
                    <li><a href="category.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Category</a></li>
                    <li><a href="tag.php" class="block px-4 py-2 hover:bg-blue-700">Tag</a></li>
                    <li><a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Article</a></li>
                </ul>
            </nav>
            <div class="p-4">
                <a href="app/auth/login.php">
                    <button class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
                </a>
            </div>
            <div class="p-4 text-sm text-center">&copy; 2025 Dashboard</div>
        </aside>

        
        <main class="flex-1 p-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h1 class="text-2xl font-semibold mb-4">Edit tag</h1>


                <form action="" method="POST">
                    <div class="mb-4">
                        <label for="nameTag" class="block text-gray-700">tag Name</label>
                        <input
                            type="text"
                            name="nameTag"
                            id="nameTag"
                            class="border border-gray-300 rounded px-4 py-2"
                            value="<?php ?>"
                            required
                        />
                    </div>
                    <button name="update-tag" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update tag</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

