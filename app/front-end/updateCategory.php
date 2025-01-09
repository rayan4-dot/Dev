<?php


require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;
use App\Class\Category\Category;

$db = (new Database())->getConnection();

$category = new Category($db);



if(isset($_POST['update-category']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];

    $name = $_POST['categoryName'];

    $category->update(["name" => $name], $id);
    header("Location: category.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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
                <h1 class="text-2xl font-semibold mb-4">Edit Category</h1>


                <form action="" method="POST">
                    <div class="mb-4">
                        <label for="categoryName" class="block text-gray-700">Category Name</label>
                        <input
                            type="text"
                            name="categoryName"
                            id="categoryName"
                            class="border border-gray-300 rounded px-4 py-2"
                            value="<?php ?>"
                            required
                        />
                    </div>
                    <button name="update-category" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Category</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

