<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../config/database.php';

require_once '../handler/u.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-4 text-xl font-bold">User Panel</div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li><a href="../userView/addArticleU.php" class="block px-4 py-2 hover:bg-blue-700">Add Article</a></li>
                    <li><a href="../userView/articleU.php" class="block px-4 py-2 hover:bg-blue-700">View Articles</a></li>
                </ul>
            </nav>
            <div class="mt-8 text-center">
                <a href="../auth/logout.php" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Logout</a>
            </div>
            <div class="p-4 text-sm text-center">&copy; <span id="year"></span> Dev-Blog</div>
        </aside>

        <main class="flex-1 p-6 bg-gray-50">
            <div class="bg-white shadow-xl rounded-lg p-8 mb-6 max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-blue-900 mb-8">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

                <?php if (isset($userData)): ?>
                    <div class="flex justify-center items-center flex-col">
                        <img src="<?php echo htmlspecialchars($userData['profile_picture_url']); ?>" alt="Profile Picture" class="w-36 h-36 rounded-full border-4 border-blue-600 mb-6 shadow-lg">
                        <div class="w-full max-w-md text-center">
                            <p class="text-lg text-gray-700"><?php echo htmlspecialchars($userData['bio']); ?></p>
                        </div>
                        <button onclick="toggleModal()" class="mt-4 px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-300">Edit Profile</button>
                    </div>
                <?php else: ?>
                    <div class="text-center text-gray-500 mt-4">
                        <p>No profile data available. Please update your bio and profile picture.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Modal for Editing Profile -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 opacity-0 transition-opacity duration-500 ease-out transform translate-y-10 scale-95 transition-transform duration-300">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96 transform transition-transform duration-300 ease-out">
        <h3 class="text-2xl font-semibold text-center text-blue-900 mb-6">Edit Profile</h3>
        <form action="update_profile.php" method="POST">
            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm text-gray-600">Username</label>
                <input type="text" name="username" id="username" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" value="<?= htmlspecialchars($userData['username']) ?>" required>
            </div>

            <!-- Bio -->
            <div class="mb-4">
                <label for="bio" class="block text-sm text-gray-600">Bio</label>
                <textarea name="bio" id="bio" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" rows="4" required><?= htmlspecialchars($userData['bio']) ?></textarea>
            </div>

            <!-- Profile Picture URL -->
            <div class="mb-4">
                <label for="profile_picture" class="block text-sm text-gray-600">Profile Picture URL</label>
                <input type="text" name="profile_picture_url" id="profile_picture" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none" value="<?= htmlspecialchars($userData['profile_picture_url']) ?>" placeholder="Enter URL of your profile picture" required>
            </div>

            <div class="flex justify-center space-x-4">
                <button type="button" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200" onclick="toggleModal()">Cancel</button>
                <button type="submit" name="update_profile" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Save Changes</button>
            </div>
        </form>
    </div>
</div>

    <script>
        // set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();

        // Toggle the modal visibility
        function toggleModal() {
        const modal = document.getElementById('editModal');
        modal.classList.toggle('hidden');
        modal.classList.toggle('opacity-0');
        modal.classList.toggle('opacity-100');
        modal.classList.toggle('translate-y-10');
        modal.classList.toggle('translate-y-0');
        modal.classList.toggle('scale-95');
        modal.classList.toggle('scale-100');
    }
    </script>
</body>
</html>
