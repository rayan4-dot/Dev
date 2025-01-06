<?php

namespace App\Class\Category;

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
        $this->deleteRecord($id);
    }

    public function insertCategory($data){
        $this->insertRecord($this->table, $data);
    }

    public function update($data, $id){
        $this->updateRecord($this->table, $data, $id);
    }

    public function getAllCat(){
        $this->selectRecords($this->table);
    }
    
}
