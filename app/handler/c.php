
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\class\Category;
use App\Config\Database;


$database = new Database();
$db = $database->getConnection();


$category = new Category($db);
$categories = $category->getAllCat();




// Handling category creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName'])) {
    $category->name = $_POST['categoryName'];

    if ($category->insertCategory(['name' => $category->name])) {
        header("Location: category.php"); 
        exit();
    }
}

// Handling category deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $category->id = $_POST['id'];

    if ($category->deleteCategory($category->id)) {
        header("Location: category.php"); 
        exit();
    } else {
        echo "<script>alert('Failed to delete category.'); window.location.href='category.php';</script>";
    }
}

// Fetch all categories
