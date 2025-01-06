<?php
require_once __DIR__ . '/../config/database.php'; 
require_once __DIR__ . '/../category/category.php'; 

$database = new Database();
$db = $database->getConnecion();

$category = new Category($db);

if (isset($_GET['id'])) {

    $category->id = $_GET['id'];

    
    $categoryDetails = $category->readOne();
} else {
    
    header("Location: category.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName'])) {
    $category->name = $_POST['categoryName'];

    
    if ($category->update()) {
        
        header("Location: category.php");
        exit();
    }
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

        
        <main class="flex-1 p-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h1 class="text-2xl font-semibold mb-4">Edit Category</h1>

                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo '<div class="mb-4 p-2 bg-green-500 text-white rounded">Category updated successfully!</div>';
                    echo '<div class="mb-4">Old Name: ' . htmlspecialchars($categoryDetails['name']) . '</div>';
                    echo '<div class="mb-4">New Name: ' . htmlspecialchars($_POST['categoryName']) . '</div>';
                }
                ?>

                <form action="update.php?id=<?php echo $category->id; ?>" method="POST">
                    <div class="mb-4">
                        <label for="categoryName" class="block text-gray-700">Category Name</label>
                        <input
                            type="text"
                            name="categoryName"
                            id="categoryName"
                            class="border border-gray-300 rounded px-4 py-2"
                            value="<?php echo htmlspecialchars($categoryDetails['name']); ?>"
                            required
                        />
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Category</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

