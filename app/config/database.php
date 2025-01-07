<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "blogger"; 
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database connection successful!"; // Debugging line to confirm connection
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        if ($this->conn === null) {
            die("Database connection is not established.");
        }
        return $this->conn;
    }
}
