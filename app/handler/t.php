<?php 

require_once __DIR__ . '/../../vendor/autoload.php';



use App\Config\Database;

use App\class\Tag;

$database = new Database();
$db = $database->getConnection();

$tag = new Tag($db);
$tags = $tag->display();



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tag'])) {
    $tag->name = $_POST['name'];


    if ($tag->insertTag(['name' => $tag->name])) {
        echo "<script>alert('Tag added successfully!');</script>";
    } else {
        echo "<script>alert('Failed to add tag.');</script>";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_id'])) {
    $tag->id = $_GET['delete_id'];


    if ($tag->deleteTag($tag->id)) {
        echo "<script>alert('Tag deleted successfully!');</script>";
    } else {
        echo "<script>alert('Failed to delete tag.');</script>";
    }
}