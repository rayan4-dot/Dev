<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $result = $conn->query("SELECT * FROM articles WHERE id = $id");
    if ($result->num_rows == 0) {
        die("Article not found.");
    }
    $article = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $tags = $_POST['tags']; 


    $stmt = $conn->prepare("UPDATE articles SET title = ?, slug = ?, content = ?, category_id = ? WHERE id = ?");
    $stmt->bind_param('sssii', $title, $slug, $content, $category_id, $id);
    $stmt->execute();


    $tagsArray = explode(',', $tags); 
    foreach ($tagsArray as $tag) {
        $stmt_tag = $conn->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (?, (SELECT id FROM tags WHERE name = ?))");
        $stmt_tag->bind_param('is', $id, $tag);
        $stmt_tag->execute();
    }

    $stmt->close();
    $conn->close();


    header("Location: article.php");
    exit();
}
?>
