<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Class\Dashboard\Dashboard;
use App\Config\Database;


$database = new Database();
$db = $database->getConnection();



$dashboard = new Dashboard($db);


$totalUsers = $dashboard->getTotalUsers();
$totalArticles = $dashboard->getTotalArticles();
$totalCategories = $dashboard->getTotalCategories();
$recentArticles = $dashboard->getRecentArticles(3); 
$topAuthors = $dashboard->getTopAuthors(3);        
