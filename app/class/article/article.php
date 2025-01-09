<?php

namespace App\Class\Article;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Class\Crud\Crud;
use PDO;

class Article extends Crud {
    private $table = "articles";

    public $id;
    public $name;

    public function getAllArticles() {
        $sql = "
            SELECT a.*, c.name AS category_name, u.username AS author_name
            FROM articles a
            JOIN categories c ON a.category_id = c.id
            JOIN users u ON a.author_id = u.id
        ";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($articles);
        foreach ($articles as &$article) {
            $article['tags'] = $this->getTagsForArticle($article['id']);
        }

        return $articles;
    }

    public function createArticle($title, $slug, $content, $category_id, $tags) {
        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'category_id' => $category_id,
            
        ];

        $article_id = $this->insertRecord($this->table, $data);

        if (!empty($tags)) {
            $this->attachTagsToArticle($article_id, $tags);
        }
    }

    private function getTagsForArticle($article_id) {
        $sql = "
            SELECT t.name AS tag_name
            FROM tags t
            JOIN article_tags at ON t.id = at.tag_id
            WHERE at.article_id = :article_id
        ";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return implode(', ', array_column($tags, 'tag_name'));
    }

    private function attachTagsToArticle($article_id, $tags) {
        foreach ($tags as $tag_name) {
            $tag_id = $this->getOrCreateTag($tag_name);
            $this->insertRecord('article_tags', [
                'article_id' => $article_id,
                'tag_id' => $tag_id
            ]);
        }
    }

    private function getOrCreateTag($tag_name) {
        $sql = "SELECT id FROM tags WHERE name = :tag_name";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($tag) {
            return $tag['id'];
        }
    
        return $this->insertRecord('tags', ['name' => $tag_name]);
    }
    
}
