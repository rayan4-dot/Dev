<?php

namespace App\Class\Dashboard;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Class\Crud\Crud;

class Dashboard extends Crud {

    public function getTotalUsers() {
        $result = $this->selectRecords('users', 'COUNT(*) AS total');
        return $result ? $result[0]['total'] : 0;
    }       

    public function getTotalArticles() {
        $result = $this->selectRecords('articles', 'COUNT(*) AS total');
        // return $result ? [['total' => 0]] : null;
    }
    public function getTotalCategories() {
        $result = $this->selectRecords('categories', 'COUNT(*) AS total');
        return $result ? $result[0]['total'] : 0;
    }
}

?>
