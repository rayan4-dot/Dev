<?php



namespace App\Class;

use App\Class\Crud\Crud;

require_once __DIR__ . '/../../../vendor/autoload.php';



// Remove the $conn property and constructor
class Tag extends Crud {
    private $table = "tags"; 

    public $id;
    public $name;

    public function insertTag($data) {
        $this->insertRecord($this->table, $data);
    }

    public function deleteTag($id) {
        $this->deleteRecord($this->table, $id);
    }

    public function display() {
        return $this->selectRecords($this->table);
    }
    public function update($data, $id) {
        $this->updateRecord($this->table, $data, $id);
    }
}

?>