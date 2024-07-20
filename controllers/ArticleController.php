<?php
class ArticleController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllArticles() {
        $query = "SELECT * FROM articles";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestArticles($limit = 10) {
        $query = "SELECT * FROM articles ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function extractTags($content) {
        $content = strtolower($content);
        $content = preg_replace('/[^a-z0-9\s]+/', '', $content);
        $words = explode(' ', $content);
        $wordFrequency = array_count_values($words);
        arsort($wordFrequency);
        $tags = array_slice(array_keys($wordFrequency), 0, 10);
        return $tags;
    }

    public function saveArticle($title, $content, $author, $image) {
        $tags = $this->extractTags($content);
        $tagsString = implode(',', $tags);

        $stmt = $this->db->prepare("INSERT INTO articles (title, content, author, image, tags) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("sssss", $title, $content, $author, $image, $tagsString);
        $stmt->execute();
        $stmt->close();
    }

    public function getArticleById($id) {
        $query = "SELECT * FROM articles WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
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
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("ssssss", $title, $content, $image, $author, $created_at, $updated_at);
        if (!$stmt->execute()) {
            throw new Exception('Failed to execute statement: ' . $stmt->error);
        }
        $stmt->close();
    }

    public function updateArticle($id, $title, $content, $image, $author) {
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $image = htmlspecialchars($image);
        $author = htmlspecialchars($author);
        $updated_at = date('Y-m-d H:i:s');

        $query = "UPDATE articles SET title = ?, content = ?, image = ?, author = ?, updated_at = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("sssssi", $title, $content, $image, $author, $updated_at, $id);
        if (!$stmt->execute()) {
            throw new Exception('Failed to execute statement: ' . $stmt->error);
        }
        $stmt->close();
    }

    public function deleteArticle($id) {
        $query = "DELETE FROM articles WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new Exception('Failed to execute statement: ' . $stmt->error);
        }
        $stmt->close();
    }

    public function getMostClickedArticle() {
        $query = "SELECT * FROM articles ORDER BY clicks DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getTotalArticles() {
        $query = "SELECT COUNT(*) as total FROM articles";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getArticlesByPage($offset, $limit) {
        $query = "SELECT * FROM articles LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        if ($stmt === false) {
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPaginatedArticles($limit, $offset) {
        $stmt = $this->db->prepare("SELECT * FROM articles ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalArticleCount() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM articles");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['count'];
    }
}
?>
