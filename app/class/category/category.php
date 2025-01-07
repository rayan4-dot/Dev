<?php

namespace App\Class;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Class\Crud\Crud;

class Category extends Crud {
    private $conn;
    private $table = "categories";

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteCategory($id) {
        return $this->deleteRecord($this->table, $id);  // Pass table name and ID
    }

    public function insertCategory($data) {
        return $this->insertRecord($this->table, $data);  // Insert data into the table
    }

    public function update($data, $id) {
        return $this->updateRecord($this->table, $data, $id);  // Update record in the table
    }

    public function getAllCat() {
        return $this->selectRecords($this->table);  // Fetch all categories from the table
    }
}
