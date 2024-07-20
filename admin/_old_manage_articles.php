<?php
session_start();
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/ArticleController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: ../login.php");
    exit();
}

$db = new Database();
$articleController = new ArticleController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $author = $_POST['author'];
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Update
        $articleController->updateArticle($id, $title, $content, $image, $author);
    } else {
        // Create
        $articleController->createArticle($title, $content, $image, $author);
    }
    header("Location: manage_articles.php");
}

$articles = $articleController->getAllArticles();
$editingArticle = null;
if (isset($_GET['edit'])) {
    $editingArticle = $articleController->getArticleById($_GET['edit']);
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Articles - FK-PKPPS Ponpes</title>
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/tailwind.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#content'
      });
    </script>
    <script src="../assets/js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    <script>
      function confirmDelete(articleId) {
        if (confirm("Are you sure you want to delete this article?")) {
          window.location.href = 'delete_article.php?id=' + articleId;
        }
      }

      function cancelEdit() {
        window.location.href = 'manage_articles.php';
      }
    </script>
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Manage Articles</h1>
            <nav class="flex items-center space-x-4">
                <a href="dashboard" class="text-white hover:text-gray-200">Dashboard</a>
                <a href="manage_users" class="text-white hover:text-gray-200">Manage Users</a>
                <a href="manage_admin" class="text-white hover:text-gray-200">Manage Admin</a>
                <a href="manage_articles" class="text-white hover:text-gray-200">Manage Articles</a>
                <a href="manage_events" class="text-white hover:text-gray-200">Manage Events</a>
                <a href="manage_donations" class="text-white hover:text-gray-200">Manage Donations</a>
                <a href="manage_qr" class="text-white hover:text-gray-200">Manage QR</a>
                <a href="../controllers/LogoutController" class="text-white hover:text-gray-200">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto mt-4">
        <h2 class="text-xl font-semibold"><?php echo $editingArticle ? 'Edit Article' : 'Create New Article'; ?></h2>
        <form action="manage_articles.php" method="post" class="bg-white shadow-md rounded-md p-4">
            <input type="hidden" name="id" value="<?php echo $editingArticle['id'] ?? ''; ?>">
            <label for="title" class="block">Title:</label>
            <input type="text" name="title" id="title" class="border border-gray-300 rounded-md p-2 w-full" value="<?php echo $editingArticle['title'] ?? ''; ?>" required>
            <label for="content" class="block mt-4">Content:</label>
            <textarea name="content" id="content" class="border border-gray-300 rounded-md p-2 w-full" required><?php echo $editingArticle['content'] ?? ''; ?></textarea>
            <label for="image" class="block mt-4">Image URL:</label>
            <input type="text" name="image" id="image" class="border border-gray-300 rounded-md p-2 w-full" value="<?php echo $editingArticle['image'] ?? ''; ?>" required>
            <label for="author" class="block mt-4">Author:</label>
            <input type="text" name="author" id="author" class="border border-gray-300 rounded-md p-2 w-full" value="<?php echo $editingArticle['author'] ?? ''; ?>" required>
            <button type="submit" class="bg-blue-500 text-white rounded-md p-2 mt-4"><?php echo $editingArticle ? 'Update' : 'Create'; ?> Article</button>
            <?php if ($editingArticle): ?>
                <button type="button" onclick="cancelEdit()" class="bg-gray-500 text-white rounded-md p-2 mt-4">Cancel</button>
            <?php endif; ?>
        </form>
        <h2 class="text-xl font-semibold mt-8">All Articles</h2>
        <?php foreach ($articles as $article): ?>
            <div class="bg-white shadow-md rounded-md p-4 mb-4">
                <h3 class="text-lg font-bold"><?php echo htmlspecialchars($article['title']); ?></h3>
                <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full h-48 object-cover rounded-md mb-2">
                <p><?php echo htmlspecialchars($article['content']); ?></p>
                <div class="text-sm text-gray-600 mt-2">
                    <p>Ditulis oleh: <?php echo htmlspecialchars($article['author']); ?></p>
                    <p>Dibuat pada: <?php echo htmlspecialchars($article['created_at']); ?></p>
                    <p>Diperbarui pada: <?php echo htmlspecialchars($article['updated_at']); ?></p>
                </div>
                <a href="manage_articles.php?edit=<?php echo $article['id']; ?>" class="text-blue-500">Edit</a>
                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $article['id']; ?>)" class="text-red-500 ml-2">Delete</a>
            </div>
        <?php endforeach; ?>
    </main>
    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2024 FK-PKPPS Ponpes. All rights reserved.</p>
    </footer>
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
