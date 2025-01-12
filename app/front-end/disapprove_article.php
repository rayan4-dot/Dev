<?php


require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;
use App\Class\Article\Article;

session_start();


if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = new Article();

    if ($article->disapproveArticle($articleId)) {
        echo "Article disapproved!";  
        header("Location: approveArticles.php");
        exit();
    } else {
        echo "Error disapproving the article.";
    }
    
}
?>


//dissaprove doesn't work yet
