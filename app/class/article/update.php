
<?php
include 'handle.php';
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

        </select><br><br>

        <label for="tags">Tags (comma separated)</label>
        <input type="text" id="tags" name="tags" value="<?php echo implode(',', $article['tags']); ?>"><br><br>

        <button type="submit">Update Article</button>
    </form>
</body>
</html>
