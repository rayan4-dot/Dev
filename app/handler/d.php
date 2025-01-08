<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Dashboard\Dashboard;
use App\Config\Database;

// Initialize the database connection
$database = new Database();
$db = $database->getConnection();

// Initialize the Dashboard class
$dashboard = new Dashboard();

// Fetch totals for users, articles, and categories
$totalUsers = $dashboard->getTotalUsers();
$totalArticles = $dashboard->getTotalArticles();
$totalCategories = $dashboard->getTotalCategories();