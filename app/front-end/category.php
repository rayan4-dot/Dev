<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../config/database.php'; 
require_once __DIR__ . '/../class/category/category.php'; 


use App\Class\Category\Category;

$database = new Database();
$db = $database->getConnection();

$category = new  Category($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName'])) {
    $category->name = $_POST['categoryName'];

    if ($category->createCateogry(['name' => $category->name])) {
        header("Location: category.php"); 
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $category->id = $_POST['id'];


    if ($category->deleteCategory($category->id)) {
        header("Location: category.php"); 
        exit();
    } else {
        echo "<script>alert('Failed to delete category.'); window.location.href='category.php';</script>";
    }
}


// $categories = $category->getAllCat();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management Dashboard</title>
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

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h1 class="text-2xl font-semibold mb-4">Manage Categories</h1>
                <div class="flex justify-between items-center mb-4">
                    <form action="category.php" method="POST">
                        <input
                            type="text"
                            name="categoryName"
                            placeholder="Enter category name"
                            class="border border-gray-300 rounded px-4 py-2"
                            required
                        />
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Category</button>
                    </form>
                    <input
                        type="text"
                        placeholder="Search categories..."
                        class="border border-gray-300 rounded px-4 py-2"
                    />
                </div>
                <table class="w-full border border-gray-300 bg-white rounded shadow-md">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Category Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php foreach ($categories as $category): ?> -->
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($category['id']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($category['name']); ?></td>
                                <td class="border border-gray-300 px-4 py-2">

                                    <form action="/app/class/category/update.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']); ?>">
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                                    </form>


                                    <form action="category.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']); ?>">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                    </form>
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
