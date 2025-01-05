 
<?php

class Database {

    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $database = "blog";
    private static $connection;

    public static function con() {
        try {
            self::$connection = new PDO("mysql:host=". self::$host . ";dbname=".self::$database, self::$user, self::$password);

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$connection;
        } catch (PDOException $e) {
            
            echo "Connection failed: " . $e->getMessage();
            return null;
        }

        return self::$connection;
    }
}