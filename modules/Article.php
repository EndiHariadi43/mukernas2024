<?php
class Article {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllArticles() {
        $query = "SELECT * FROM articles";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticleById($id) {
        $query = "SELECT * FROM articles WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createArticle($title, $content, $image, $author) {
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $image = htmlspecialchars($image);
        $author = htmlspecialchars($author);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO articles (title, content, image, author, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssss", $title, $content, $image, $author, $created_at, $updated_at);
        return $stmt->execute();
    }

    public function updateArticle($id, $title, $content, $image, $author) {
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $image = htmlspecialchars($image);
        $author = htmlspecialchars($author);
        $updated_at = date('Y-m-d H:i:s');

        $query = "UPDATE articles SET title = ?, content = ?, image = ?, author = ?, updated_at = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $title, $content, $image, $author, $updated_at, $id);
        return $stmt->execute();
    }

    public function deleteArticle($id) {
        $query = "DELETE FROM articles WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
