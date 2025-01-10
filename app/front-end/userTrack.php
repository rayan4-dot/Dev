<?php
require_once __DIR__ . '/../config/database.php';
use App\Config\Database;



try {
    $db = new Database();
    $conn = $db->getConnection();


    $sql = "SELECT id, username, email, profile_picture_url, role FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // andle role update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_role'])) {
        $userId = $_POST['user_id'];
        $newRole = $_POST['role'];

        $updateSql = "UPDATE users SET role = :role WHERE id = :id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':role', $newRole);
        $updateStmt->bindParam(':id', $userId);
        $updateStmt->execute();
        
        header("Location: userTrack.php"); 
        exit;
    }

    // handle user deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
        $userId = $_POST['user_id'];

        $deleteSql = "DELETE FROM users WHERE id = :id";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $userId);
        $deleteStmt->execute();

        header("Location: userTrack.php"); 
        exit;
    }
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Tracking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-4 text-xl font-bold">Admin</div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li><a href="dashboard.php" class="block px-4 py-2 hover:bg-blue-700 font-bold">Home</a></li>
                    <li><a href="userTrack.php" class="block px-4 py-2 hover:bg-blue-700">Users</a></li>
                    <li><a href="category.php" class="block px-4 py-2 hover:bg-blue-700">Category</a></li>
                    <li><a href="tag.php" class="block px-4 py-2 hover:bg-blue-700">Tag</a></li>
                    <li><a href="article.php" class="block px-4 py-2 hover:bg-blue-700">Pending</a></li>
                </ul>
            </nav>
            <div class="p-4">
                <form action="" method="POST">
                <a href="../auth/logout.php" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Logout</a>
                </form>
            </div>
            <div class="p-4 text-sm text-center">&copy; <span id="year"></span> Dev-Blog</div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6">User Tracking</h1>

            <?php if ($error_message): ?>
                <div class="bg-red-500 text-white text-center p-2 mb-4 rounded">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>

                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Profile Picture</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="border-b">

                            <td class="px-4 py-2"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="px-4 py-2 text-center">
                                <?php if (!empty($user['profile_picture_url'])): ?>
                                    <img src="<?php echo htmlspecialchars($user['profile_picture_url']); ?>" alt="Profile Picture" class="w-10 h-10 rounded-full mx-auto">
                                <?php else: ?>
                                    <span class="text-gray-500 italic">No Picture</span>
                                <?php endif; ?>
                            </td> 
                            <td class="px-4 py-2 text-center"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="px-4 py-2 text-center">

                                 
                             <form action="userTrack.php" method="POST" class="inline-block">
                 <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                         <select name="role" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                    <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                     <option value="author" <?php echo $user['role'] === 'author' ? 'selected' : ''; ?>>Author</option>
                            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                     </select>
              <input type="hidden" name="update_role" value="1">
                    </form>

                                <form action="userTrack.php" method="POST" class="inline-block">
                                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                    <button type="submit" name="delete_user" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
    <script>
        // Automatically set the current year in the footer
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>
</html>
