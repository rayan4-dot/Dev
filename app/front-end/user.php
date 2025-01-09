<?php
session_start();


$username = $_SESSION['username'];
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
                    <li><a href="../userView/articleU.php" class="block px-4 py-2 hover:bg-blue-700">Article</a></li>
                    <li><a href="../userView/categoryU.php" class="block px-4 py-2 hover:bg-blue-700">read Article</a></li>
                </ul>
            </nav>
            <div class="p-4 text-sm text-center">&copy; <span id="year"></span> Dev-Blog</div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Welcome Section -->
            <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                <h2 class="text-2xl font-bold">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

            </div>

            <!-- Additional content can go here -->
        </main>
    </div>

    <script>
        // Set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>
