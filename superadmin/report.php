<?php
session_start();
require_once dirname(__DIR__) . '/modules/Database.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: /");
    exit();
}
$db = new Database();
$conn = $db->getConnection();

$userCountQuery = "SELECT COUNT(*) AS user_count FROM users";
$userCountResult = $conn->query($userCountQuery)->fetch_assoc();

$donationSumQuery = "SELECT SUM(amount) AS total_donations FROM donations";
$donationSumResult = $conn->query($donationSumQuery)->fetch_assoc();

$articleCountQuery = "SELECT COUNT(*) AS article_count FROM articles";
$articleCountResult = $conn->query($articleCountQuery)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - FK-PKPPS Ponpes</title>
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/tailwind.css">
</head>
<body>    
    <?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>
    <main class="container mx-auto mt-4">
        <h2 class="text-xl font-semibold">Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-lg font-bold">Total Users</h3>
                <p><?php echo $userCountResult['user_count']; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-lg font-bold">Total Donations</h3>
                <p><?php echo $donationSumResult['total_donations']; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-md p-4">
                <h3 class="text-lg font-bold">Total Articles</h3>
                <p><?php echo $articleCountResult['article_count']; ?></p>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2024 FK-PKPPS Ponpes. All rights reserved.</p>
    </footer>
</body>
</html>
