<?php 

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;
use App\Class\Tags\Tag; 

$database = new Database();
$db = $database->getConnection();

$tag = new Tag($db);
$tags = $tag->display();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nameTag'])) {
    $tag->name = $_POST['nameTag'];


    if ($tag->insertTag(['name' => $tag->name])) {
        header("Location: tag.php"); 
        exit();
    } 
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $tag->id = $_POST['delete_id'];


    if ($tag->deleteTag($tag->id)) {
        header("Location: tag.php"); 
        exit();  
      } 
}