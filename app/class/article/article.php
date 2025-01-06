<?php

class Article {
    private $db;


    public function __construct($db) {
        $this->db = $db;
    }

// app/class/article/article.php

public function getAllArticles() {
    $stmt = $this->db->prepare("
SELECT a.*, c.name AS category_name, u.username AS author_name
FROM articles a
JOIN categories c ON a.category_id = c.id
JOIN users u ON a.author_id = u.id;

    ");
    $stmt->execute();

    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($articles as &$article) {
        $stmt = $this->db->prepare("
        SELECT t.name AS tag_name 
        FROM tags t
        JOIN article_tags at ON t.id = at.tag_id
        WHERE at.article_id = :article_id
    ");
    $stmt->bindParam(':article_id', $article['id']);
    $stmt->execute();
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    $tag_names = array_column($tags, 'tag_name');
    $article['tags'] = implode(', ', $tag_names);

    }

    return $articles;
}


    public function create($title, $slug, $content, $category_id, $tags) {

        $stmt = $this->db->prepare("INSERT INTO articles (title, slug, content, category_id) VALUES (:?, :?, :?, :?");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();


        $article_id = $this->db->lastInsertId();


        if (!empty($tags)) {

            foreach ($tags as $tag_name) {

                $stmt = $this->db->prepare("SELECT id FROM tags WHERE name = :tag_name");
                $stmt->bindParam(':tag_name', $tag_name);
                $stmt->execute();
                $tag = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$tag) {

                    $stmt = $this->db->prepare("INSERT INTO tags (name) VALUES (:tag_name)");
                    $stmt->bindParam(':tag_name', $tag_name);
                    $stmt->execute();
                    $tag_id = $this->db->lastInsertId(); 
                } else {

                    $tag_id = $tag['id'];
                }
                

                $stmt = $this->db->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (:article_id, :tag_id)");
                $stmt->bindParam(':article_id', $article_id);
                $stmt->bindParam(':tag_id', $tag_id);
                $stmt->execute();
            }
        }
    }
}
