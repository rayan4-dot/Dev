<?php
namespace App\Class\Article;

use App\Config\Database;

class Article
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection(); 
    }

    public function insertArticle($title, $slug, $content, $category_id, $status, $scheduled_date, $author_id, $tags)
    {
        // List of valid status values
        $validStatuses = ['draft', 'published', 'scheduled', 'pending'];
    
        // Check if the status provided is valid
        if (!in_array($status, $validStatuses)) {
            // Default to 'pending' if an invalid status is provided
            $status = 'pending';
        }
    
        $sql = "INSERT INTO articles (title, slug, content, category_id, status, scheduled_date, author_id) 
                VALUES (:title, :slug, :content, :category_id, :status, :scheduled_date, :author_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':scheduled_date', $scheduled_date);
        $stmt->bindParam(':author_id', $author_id);
        
        return $stmt->execute();
    }
    
    public function disapproveArticle($id)
    {
        $status = 'pending';  // Set status to 'pending' for disapproval
    
        // Make sure this query is correct
        $sql = "UPDATE articles SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }
    

    public function getPendingArticles()
{
    $sql = "SELECT * FROM articles WHERE status = 'pending' ORDER BY created_at DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function approveArticle($id)
{
    // Define the status as 'published'
    $status = 'published';

    // Prepare the SQL statement to update the article's status
    $sql = "UPDATE articles SET status = :status WHERE id = :id";
    $stmt = $this->conn->prepare($sql);

    // Bind the parameters to the prepared statement
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    // Execute the statement and return the result (true or false)
    return $stmt->execute();
}




    
    public function getAllArticles()
    {
        $sql = "SELECT * FROM articles WHERE status = 'published' ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getArticleById($id)
    {
        $sql = "
            SELECT 
                articles.*, 
                categories.name AS category_name, 
                users.username AS author_name
            FROM articles
            INNER JOIN categories ON articles.category_id = categories.id
            INNER JOIN users ON articles.author_id = users.id
            WHERE articles.id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    


    



    public function updateArticle($id, $title, $slug, $content, $category_id, $status, $scheduled_date)
{
    $sql = "UPDATE articles
            SET title = :title, slug = :slug, content = :content, category_id = :category_id, status = :status, scheduled_date = :scheduled_date
            WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':scheduled_date', $scheduled_date);

    return $stmt->execute();
}



public function deleteArticle($id)
{
    $sql = "DELETE FROM articles WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}



public function deleteArticleById($id)
{
    $sql = "DELETE FROM articles WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}


public function getAllArticlesForAdmin()
{
    $sql = "SELECT articles.*, categories.name AS category_name, users.username AS author_name
            FROM articles
            LEFT JOIN categories ON articles.category_id = categories.id
            LEFT JOIN users ON articles.author_id = users.id
            ORDER BY articles.created_at DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}





}
?>
