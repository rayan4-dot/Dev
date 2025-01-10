<?php

namespace App\Class\Dashboard;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Class\Crud\Crud;


class Dashboard extends Crud {


    public function getRecentArticles() {
        $sql = "SELECT title, created_at FROM articles ORDER BY created_at DESC LIMIT 5";
        $stmt = $this->getConnection()->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getTotalUsers() {
        $result = $this->selectRecords('users', 'COUNT(*) AS total');
        return $result ? $result[0]['total'] : 0;
    }       

    public function getTotalArticles() {
        $result = $this->selectRecords('articles', 'COUNT(*) AS total');
        return $result ? $result[0]['total'] : 0;
    }
    public function getTotalCategories() {
        $result = $this->selectRecords('categories', 'COUNT(*) AS total');
        return $result ? $result[0]['total'] : 0;
    }


    // public function getRecentArticles() {
    //     var_dump($this->conn); // This will print the connection object or null
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }
    

    public function getTopAuthors() {
        $sql = "SELECT u.username AS author_name, COUNT(*) AS article_count 
                FROM articles a 
                JOIN users u ON a.author_id = u.id 
                GROUP BY a.author_id 
                ORDER BY article_count DESC ";
        $stmt = $this->getConnection()->prepare($sql);  
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    
}



?>
