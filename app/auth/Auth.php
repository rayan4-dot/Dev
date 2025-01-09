<?php
class Auth
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
        session_start();
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
    

                error_log("user role: " . $_SESSION['role']);  
    
                if ($_SESSION['role'] === 'admin') {
                    header("Location: /Dev-Blog/app/front-end/dashboard.php");
                } else {
                    header("Location: /Dev-Blog/app/front-end/user.php");
                }
                exit;
            } 
        } catch (PDOException $e) {
            return "Database error: " . $e->getMessage();
        }
    }
    
    

}
