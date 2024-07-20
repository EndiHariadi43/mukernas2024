<?php
session_start();
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/DonationController.php';
$db = new Database();
$donationController = new DonationController($db);
// Periksa index.php
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], '<?php echo BASE_URL; ?>') === true) {
    header("Location: /");
    exit();
}
$status = isset($_GET['status']) ? $_GET['status'] : null;
$token = isset($_GET['token']) ? $_GET['token'] : null;
// terima kasih
if ($status === 'success' && $token) {
    $donor_name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Hamba Allah';
    $message = "Terima kasih atas partisipasi Anda, $donor_name!";
} else {
    // Redirect Midtrans untuk pembayaran
    header('Location: https://app.midtrans.com/payment-links/1721306571923');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Donasi - FK-PKPPS Ponpes</title>
    <?php include 'parsial/meta.php'; ?>
</head>
<body>
    <?php include 'parsial/navbar.php'; ?>
    <!-- BannerStart -->
    <div class="relative z-10 overflow-hidden pb-[60px] pt-[120px] bg-primary dark:bg-dark md:pt-[130px] lg:pt-[160px]">
        <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-stroke/0 via-stroke to-stroke/0 dark:via-dark-3"></div>
        <div class="container">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4">
                    <div class="text-center">
                        <h1 class="mb-4 text-3xl font-bold text-white dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]"> Donasi </h1>
                        <p class="mb-5 text-base text-white text-body-color dark:text-dark-6"> Kami masih perlu dukungan untuk membangun komunitas. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BannerEnd -->
    <!-- AboutStart -->
    <section class="py-14 lg:py-20 h-full">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
                    <div class="max-w-[525px] mx-auto text-center bg-white dark:bg-dark-2 rounded-lg py-14 px-8 sm:px-12 md:px-[60px]">
                        <?php if (isset($message)): ?>
                            <h2 class="mb-10 text-2xl font-semibold"><?php echo $message; ?></h2>
                        <?php else: ?>
                            <h2 class="mb-10 text-2xl font-semibold">Memproses Donasi Anda...</h2>
                        <?php endif; ?>
                        <a href="<?php echo BASE_URL; ?>" class="inline-block mt-5 rounded-md border border-transparent bg-primary px-7 py-3 text-base font-medium text-white transition hover:bg-blue-dark">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- AboutEnd -->
    <?php include 'parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
        <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
