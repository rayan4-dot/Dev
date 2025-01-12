<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Config\Database;
use App\Class\Article\Article;

require_once __DIR__ . '/../class/article/article.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$article = new Article();

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];


    $result = $article->deleteArticleById($articleId);

    if ($result) {

        header("Location: adminArticles.php?success=1");
    } else {

        header("Location: adminArticles.php?error=1");
    }
    exit;
} else {
    header("Location: adminArticles.php?error=1");
    exit;
}
