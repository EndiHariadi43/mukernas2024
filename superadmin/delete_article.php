<?php
session_start();
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/ArticleController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_articles.php");
    exit();
}

$id = $_GET['id'];
$db = new Database();
$articleController = new ArticleController($db);

$articleController->deleteArticle($id);

header("Location: manage_articles.php");
exit();
?>
