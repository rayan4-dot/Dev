<?php

require_once __DIR__ . '/../config/database.php';

class Crud 
{


    private $conn;

    // public function __construct()
    // {
    //     $this->conn = $this->con();
    //     if (!$this->conn) {
    //         die("Connection failed");
    //     } else {
    //         echo "Connection successful";
    //     }
    // }



    public function insertRecord($table, $data)
    {
        $db = Database::con();
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        var_dump($sql);

        $stmt = $db->prepare($sql);

        $result = $stmt->execute(array_values($data));
        
        if(!$result){
            echo "Record not inserted";
        }
     
    }


    public function deleteRecord($table, $id) {

        $sql = "DELETE FROM $table WHERE player_id = ?";
    
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Error in prepared statement: " . $this->conn->errorInfo());
        }
    
        $stmt->execute([$id]);
    }


    function updateRecord($table, $data, $id) {

        $args = array();

        // UPDATE players SET name = ?, position = ?, rating = ? WHERE player_id = ?
    
        foreach ($data as $key => $value) {
            // $args[] = "$key = ?";
            array_push($args, "$key = ?");
        }
        /*
        $args = [
            'name = ?',
            'position = ?',
            'rating = ?',
        ];
        */
    
        $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE player_id = ?";
    
        $stmt= $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Error in prepared statement: "  );
        }
        $stmt->execute(array_merge(array_values($data), [$id]));
    }





    
    //  SELECT * FROM playersWHERE player_id = 1

    function selectRecords($table, $columns = "*", $where = null) {

        $sql = "SELECT $columns FROM $table";
    
        if ($where !== null) {

            $sql .= " WHERE $where";
        }
    
        $stmt =  $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Error in prepared statement: ");
        }
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
