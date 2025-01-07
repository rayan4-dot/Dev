<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Class\Database;


$db = (new Database())->connect();


$query = "
    SELECT 
        articles.id AS article_id, 
        articles.title, 
        users.id AS user_id,
        users.username, 
        u.role
    FROM 
        articles 
    JOIN 
        users  
    ON 
        articles.author_id = users.id
";
$stmt = $db->prepare($query);



if (!$articles) {
    $articles = [];
}
?>
  <main class="flex-1 p-6">
  <div class="bg-white shadow-md rounded-lg p-4">
    <h1 class="text-2xl font-bold mb-4">Manage Articles and Roles</h1>
    <table class="w-full border border-gray-300 bg-white rounded shadow-md">
      <thead class="bg-gray-100">
        <tr>
          <th class="border border-gray-300 px-4 py-2 text-left">Article ID</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Author</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($articles)): ?>
          <?php foreach ($articles as $article): ?>
            <tr>
              <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['article_id']); ?></td>
              <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['title']); ?></td>
              <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($article['username']); ?></td>
              <td class="border border-gray-300 px-4 py-2">
                <form action="update_role.php" method="POST">
                  <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($article['user_id']); ?>">
                  <select name="role" class="border border-gray-300 rounded px-2 py-1">
                    <option value="user" <?php echo $article['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                    <option value="author" <?php echo $article['role'] == 'author' ? 'selected' : ''; ?>>Author</option>
                  </select>
                  <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 ml-2">Update</button>
                </form>
              </td>
              <td class="border border-gray-300 px-4 py-2">
                <a href="edit_article.php?id=<?php echo htmlspecialchars($article['article_id']); ?>">
                  <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Edit</button>
                </a>
                <form action="delete_article.php" method="POST" style="display: inline;">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['article_id']); ?>">
                  <button type="submit" onclick="return confirm('Are you sure you want to delete this article?');" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">No articles found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>
