<?php
// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the article data
    $result = $conn->query("SELECT * FROM articles WHERE id = $id");
    if ($result->num_rows == 0) {
        die("Article not found.");
    }
    $article = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $tags = $_POST['tags']; // Assuming this is a comma-separated list

    // Update the article
    $stmt = $conn->prepare("UPDATE articles SET title = ?, slug = ?, content = ?, category_id = ? WHERE id = ?");
    $stmt->bind_param('sssii', $title, $slug, $content, $category_id, $id);
    $stmt->execute();

    // Update tags
    $tagsArray = explode(',', $tags); // Split the tags by commas
    foreach ($tagsArray as $tag) {
        $stmt_tag = $conn->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (?, (SELECT id FROM tags WHERE name = ?))");
        $stmt_tag->bind_param('is', $id, $tag);
        $stmt_tag->execute();
    }

    $stmt->close();
    $conn->close();

    // Redirect to the articles page
    header("Location: article.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>
<body>
    <h1>Edit Article</h1>
    <form action="edit_article.php?id=<?php echo $id; ?>" method="POST">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?php echo $article['title']; ?>" required><br><br>

        <label for="slug">Slug</label>
        <input type="text" id="slug" name="slug" value="<?php echo $article['slug']; ?>" required><br><br>

        <label for="content">Content</label>
        <textarea id="content" name="content" required><?php echo $article['content']; ?></textarea><br><br>

        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            <!-- You should fetch categories from your database here -->
            <option value="1" <?php echo ($article['category_id'] == 1) ? 'selected' : ''; ?>>Technology</option>
            <option value="2" <?php echo ($article['category_id'] == 2) ? 'selected' : ''; ?>>Lifestyle</option>
        </select><br><br>

        <label for="tags">Tags (comma separated)</label>
        <input type="text" id="tags" name="tags" value="<?php echo implode(',', $article['tags']); ?>"><br><br>

        <button type="submit">Update Article</button>
    </form>
</body>
</html>
