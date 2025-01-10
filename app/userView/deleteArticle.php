<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Class\Article\Article;

require_once __DIR__ . '/../class/article/article.php';
require_once __DIR__ . '/../../vendor/autoload.php';


if (!isset($_GET['id'])) {
    die("Article ID is required.");
}

$articleId = $_GET['id'];


$article = new Article();


$article->deleteArticle($articleId);


header("Location: articleU.php");
exit();
