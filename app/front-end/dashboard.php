<?php
// session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit;


require_once '../class/Dashboard/dashboard.php';
require_once '../handler/d.php';

// $recentArticles = $article->getAllArticles();
// var_dump($recentArticles);

?>



<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom CSS for smooth animations */
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* .hover-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }


        .button-transition {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-transition:hover {
            transform: translateY(-2px);
            background-color: #2563eb;
        } */
    </style>
</head>
<body class="bg-gray-100 h-screen">

    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-56 bg-blue-900 text-white flex flex-col shadow-md lg:w-64 xl:w-75">
            <div class="p-6 text-xl font-bold text-center">Admin Dashboard</div>
            <nav class="flex-1">
                <ul class="space-y-4">
                    <li><a href="dashboard.php" class="block px-6 py-3 hover:bg-blue-700 font-semibold transition-colors">Home</a></li>
                    <li><a href="userTrack.php" class="block px-6 py-3 hover:bg-blue-700 font-semibold transition-colors">Users</a></li>
                    <li><a href="category.php" class="block px-6 py-3 hover:bg-blue-700 font-semibold transition-colors">Category</a></li>
                    <li><a href="tag.php" class="block px-6 py-3 hover:bg-blue-700 font-semibold transition-colors">Tag</a></li>
                    <li><a href="adminArticles.php" class="block px-6 py-3 hover:bg-blue-700 font-semibold transition-colors">Manage Articles</a></li>
                    <li><a href="approveArticles.php" class="block px-6 py-3 hover:bg-blue-700 font-semibold transition-colors">Pending</a></li>

                </ul>
            </nav>
            <div class="p-6 mt-auto">
                <form action="dashboard.php" method="POST">
                    <a href="../auth/logout.php" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Logout</a>
                </form>
            </div>
            <div class="p-4 text-sm text-center mt-8">&copy; <span id="year"></span> Dev-Blog</div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto fade-in">
            <!-- Welcome Section -->
            <div class="bg-white shadow-xl rounded-lg p-8 mb-10 hover-card transition-all">
                <h2 class="text-3xl font-bold text-gray-800">Welcome Boss</h2>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
                <div class="bg-blue-500 text-white p-8 rounded-xl shadow-lg hover-card transition-all">
                    <h3 class="text-xl font-semibold">Total Users</h3>
                    <p class="text-4xl font-bold"><?php echo $totalUsers; ?></p>
                </div>
                <div class="bg-green-500 text-white p-8 rounded-xl shadow-lg hover-card transition-all">
                    <h3 class="text-xl font-semibold">Total Articles</h3>
                    <p class="text-4xl font-bold"><?php echo $totalArticles; ?></p>
                </div>
                <div class="bg-yellow-500 text-white p-8 rounded-xl shadow-lg hover-card transition-all">
                    <h3 class="text-xl font-semibold">Categories</h3>
                    <p class="text-4xl font-bold"><?php echo $totalCategories; ?></p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
                <div class="bg-white p-8 rounded-xl shadow-lg hover-card transition-all">
                    <h3 class="text-xl font-semibold mb-4">User Growth</h3>
                    <canvas id="userChart"></canvas>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover-card transition-all">
                    <h3 class="text-xl font-semibold mb-4">Article Statistics</h3>
                    <canvas id="articleChart"></canvas>
                </div>
            </div>

            <!-- Recent Articles Section -->
            <div class="bg-white p-8 rounded-xl shadow-lg mb-10 hover-card transition-all">
                <h3 class="text-2xl font-semibold text-gray-700 mb-6">Recent Articles</h3> 
                
                <ul class="space-y-4">
                    <?php foreach ($recentArticles as $article): ?>
                        <li class="flex items-center justify-between p-6 border-b hover:bg-gray-50 cursor-pointer transition-all">
                            <div class="font-medium text-lg text-gray-800"><?= htmlspecialchars($article['title']) ?></div>

                            
                            <div class="text-sm text-gray-500"><?= date('F j, Y', strtotime($article['created_at'])) ?></div>      
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Top Authors Section -->
            <div class="bg-white p-8 rounded-xl shadow-lg mb-10 hover-card transition-all">
                <h3 class="text-2xl font-semibold text-gray-700 mb-6">Top Authors</h3>
                <ul class="space-y-4">
                    <?php foreach ($topAuthors as $author): ?>
                        <li class="flex items-center justify-between p-6 border-b hover:bg-gray-50 cursor-pointer transition-all">
                            <div class="font-medium text-lg text-gray-800"><?= htmlspecialchars($author['author_name']) ?></div>
                            <div class="text-sm text-gray-500">Articles: <?= htmlspecialchars($author['article_count']) ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </main>
    </div>

    <script>
        // Set dynamic year in footer
        document.getElementById('year').textContent = new Date().getFullYear();

        // User Growth Chart
        const userCtx = document.getElementById('userChart').getContext('2d');
        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'New Users',
                    data: [10, 15, 20, 25, 30, 35],  // Replace with actual user growth data
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
            }
        });

        // Article Statistics Chart
        const articleCtx = document.getElementById('articleChart').getContext('2d');
        new Chart(articleCtx, {
            type: 'bar',
            data: {
                labels: ['Category 1', 'Category 2', 'Category 3', 'Category 4'], // Replace with actual category names
                datasets: [{
                    label: 'Articles',
                    data: [12, 19, 3, 5],  // Replace with actual article data per category
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 205, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 205, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
