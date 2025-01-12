<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Article\Article;


if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = new Article();


    if ($article->approveArticle($articleId)) {
        echo "Article approved successfully!";
    } else {
        echo "Error approving article.";
    }
} else {
    echo "No article ID provided.";
}



if (isset($_GET['status']) && $_GET['status'] == 'disapproved') {
    echo '<div class="bg-green-200 text-green-800 p-4 mb-6 rounded-md">Article disapproved.</div>';
}
?>

