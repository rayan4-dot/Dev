<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Article\Article;
use App\Class\Category\Category;
use App\Class\Tags\Tag;
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$category = new Category($db);

$categories = $category->getAllCat();

$tag = new Tag($db);
$tags = $tag->display(); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category'];
    $tags = $_POST['tags'] ?? []; 




    header("Location: article.php");
    exit();
}

?>
