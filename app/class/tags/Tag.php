<?php
class Tag {
    private $conn;
    private $table = "tags"; 

    public $id;
    public $name;


    public function __construct($db) {
        $this->conn = $db;
    }


    public function insert() {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(':name', $this->name);


        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }


    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(':id', $this->id);


        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }


    public function display() {
        $query = "SELECT * FROM " . $this->table;


        $stmt = $this->conn->prepare($query);


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function update() {
        $query = "UPDATE tags SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->name, $this->id); 
        return $stmt->execute();
    }
    
    
}
?>
