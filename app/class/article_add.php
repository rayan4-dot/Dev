<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $tags = $_POST['tags']; // Assuming this is a comma-separated list
    $author_id = 1; // Set the author ID manually, or get it from the session

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the new article
    $stmt = $conn->prepare("INSERT INTO articles (title, slug, content, category_id, author_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssii', $title, $slug, $content, $category_id, $author_id);
    $stmt->execute();

    // Insert tags (assuming tags are already added to the tags table)
    $article_id = $stmt->insert_id; // Get the ID of the newly inserted article
    $tagsArray = explode(',', $tags); // Split the tags by commas
    foreach ($tagsArray as $tag) {
        $stmt_tag = $conn->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (?, (SELECT id FROM tags WHERE name = ?))");
        $stmt_tag->bind_param('is', $article_id, $tag);
        $stmt_tag->execute();
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the articles page
    header("Location: article.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
</head>
<body>
    <h1>Add New Article</h1>
    <form action="article_add.php" method="POST">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="slug">Slug</label>
        <input type="text" id="slug" name="slug" required><br><br>

        <label for="content">Content</label>
        <textarea id="content" name="content" required></textarea><br><br>

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <!-- You should fetch categories from your database here -->
            <option value="1">Technology</option>
            <option value="2">Lifestyle</option>
        </select><br><br>

        <label for="tags">Tags (comma separated)</label>
        <input type="text" id="tags" name="tags"><br><br>

        <button type="submit">Add Article</button>
    </form>
</body>
</html>
