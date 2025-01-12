<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'app/config/database.php';
use App\Config\Database;
$database = new Database();
$conn = $database->getConnection();


$sql = "SELECT id, title, excerpt, created_at FROM articles ORDER BY created_at DESC LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev-Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Hero Section Animation */
        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title {
            animation: slideUp 1s ease-out;
            color: #ffffff; /* Solid white color for better readability */
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4); /* Improved text shadow for contrast */
            letter-spacing: 2px;
            text-transform: uppercase; /* Make the title more prominent */
        }

        .hero-text {
            animation: slideUp 1.2s ease-out;
            font-size: 1.25rem;
            font-weight: 500;
            color: #ffffff; /* White color for better contrast */
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.4); /* Text shadow for better visibility */
        }

        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .article-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .read-more-button {
            transition: background-color 0.3s ease;
        }
        .read-more-button:hover {
            background-color: #2563eb;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #1e3a8a;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white p-4 navbar">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold">Dev-Blog</a>
            <ul class="flex space-x-6">
                <li><a href="app/auth/login.php" class="hover:underline text-lg">Login</a></li>
                <li><a href="app/auth/register.php" class="hover:underline text-lg">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section with Background Image, Gradient, and Animation -->
    <section class="relative bg-cover bg-center text-white py-32 text-center" style="background-image: url('blog.webp'); min-height: 400px;">
        <!-- Dark gradient overlay for improved readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-black opacity-50"></div>
        
        <div class="relative z-10 px-4 sm:px-8 py-16">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 hero-title">Welcome to Dev-Blog</h1>
            <p class="text-lg sm:text-xl hero-text">Stay updated with the latest articles on technology, programming, and more!</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-blue-900 mb-8">Latest Articles</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($articles as $article): ?>
                <div class="bg-white shadow-lg rounded-lg p-6 article-card hover:shadow-2xl">
                    <h2 class="text-xl font-bold text-blue-900 mb-4">
                        <a href="app/userView/articleDetail.php?id=<?= htmlspecialchars($article['id']) ?>" class="hover:text-blue-600">
                            <?= htmlspecialchars($article['title']) ?>
                        </a>
                    </h2>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars($article['excerpt']) ?></p>
                    <p class="text-sm text-gray-500 mb-6">Published on <?= date('F j, Y', strtotime($article['created_at'])) ?></p>
                    <a href="app/userView/articleDetail.php?id=<?= htmlspecialchars($article['id']) ?>" class="block mt-4 text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg text-center read-more-button">
                        Read More
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            &copy; <span id="year"></span> Dev-Blog. All rights reserved.
        </div>
    </footer>

    <script>
        // Set dynamic year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>
