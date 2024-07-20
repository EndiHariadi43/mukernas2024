<?php
session_start();
require_once __DIR__ . '/config.php';
require_once 'modules/Database.php';
require_once 'controllers/ArticleController.php';

if (!isset($_GET['id'])) {
    die("Artikel tidak ditemukan.");
}

$articleId = (int)$_GET['id'];

$db = new Database();
$articleController = new ArticleController($db);
$article = $articleController->getArticleById($articleId);

if (!$article) {
    die("Artikel tidak ditemukan.");
}

// Menentukan halaman sebelumnya
$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'artikel';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title><?php echo htmlspecialchars($article['title']); ?> - FK-PKPPS</title>
    <?php include 'parsial/meta.php' ?>
</head>
<body>
    <!-- ====== Navbar Section Start ====== -->
    <?php include 'parsial/navbar.php'; ?>
    <!-- ====== Navbar Section End ====== -->
    <!-- ====== CTA Section Start -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span class="text-3xl font-normal md:text-[40px]"> Detil Artikel </span>
                </h2>
                <ul class="flex items-center justify-center gap-[10px]">
                    <li>
                    <a href="artikel" class="flex items-center text-white gap-[10px] text-base font-medium text-dark dark:text-white"> Artikel </a>
                    </li>
                    <li>
                    <a href="javascript:void(0)" class="flex items-center text-white gap-[10px] text-base font-medium text-body-color">
                        <span class="text-body-color text-white dark:text-dark-6"> / </span> Artikel Detil </a>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <span class="absolute left-0 top-0">
          <svg width="495" height="470" viewBox="0 0 495 470" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="55" cy="442" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
            <circle cx="446" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
            <path d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z" stroke="white" stroke-opacity="0.08" stroke-width="12" />
          </svg>
        </span>
        <span class="absolute bottom-0 right-0">
          <svg width="493" height="470" viewBox="0 0 493 470" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="462" cy="5" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
            <circle cx="49" cy="470" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
            <path d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z" stroke="white" stroke-opacity="0.06" stroke-width="13" />
          </svg>
        </span>
      </div>
    </section>
    <!-- ====== CTA Section End -->

    <!-- ====== Article Detail Section Start ====== -->
    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark h-full">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="mb-10 wow fadeInUp" data-wow-delay=".1s">
                    <a href="<?php echo $previousPage; ?>" class="mb-4 inline-block text-primary">← Kembali ke Halaman Sebelumnya</a>
                    <div class="mb-8 overflow-hidden rounded-[5px]">
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full" />
                    </div>
                    <div>
                        <h1 class="mb-4 text-3xl font-semibold text-dark dark:text-white sm:text-4xl lg:text-3xl xl:text-4xl"><?php echo htmlspecialchars($article['title']); ?></h1>
                        <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary"><?php echo htmlspecialchars($article['created_at']); ?></span>
                        <p class="text-base text-body-color dark:text-dark-6">
                            <?php echo htmlspecialchars_decode($article['content']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Article Detail Section End ====== -->

    <?php include 'parsial/footer.php'; ?>

    <!-- ====== Footer Section End ====== -->
    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
        <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <!-- ====== Back To Top End ====== -->
    <!-- ====== All Scripts ====== -->
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
