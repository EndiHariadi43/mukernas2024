<?php
session_start();
require_once __DIR__ . '/config.php';
require_once 'modules/Database.php';
require_once 'controllers/ArticleController.php';


// Tentukan jumlah artikel per halaman
$articlesPerPage = 12;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $articlesPerPage;

$db = new Database();
$articleController = new ArticleController($db);
$totalArticles = $articleController->getTotalArticles(); // Menggunakan method baru
$totalPages = ceil($totalArticles / $articlesPerPage);
$articles = $articleController->getArticlesByPage($offset, $articlesPerPage); // Menggunakan method baru
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
      <title>Artikel - FK-PKPPS</title>
      <?php include 'parsial/meta.php' ?>
</head>
<body>
    <!-- ====== Navbar Section Start -->
    <?php include 'parsial/navbar.php'; ?>
    <!-- ====== Navbar Section End -->
    <!-- ====== CTA Section Start -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span class="text-3xl font-normal md:text-[40px]"> Daftar Artikel </span>
                </h2>
                <ul class="flex items-center justify-center gap-[10px]">
                    <li>
                    <a href="/" class="flex items-center text-white gap-[10px] text-base font-medium text-dark dark:text-white"> Beranda </a>
                    </li>
                    <li>
                    <a href="javascript:void(0)" class="flex items-center text-white gap-[10px] text-base font-medium text-body-color">
                        <span class="text-body-color text-white dark:text-dark-6"> / </span> Artikel </a>
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
    <!-- ====== Blog Section Start -->
    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark h-full">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <?php foreach ($articles as $article): ?>
                <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".1s">
                        <div class="mb-8 overflow-hidden rounded-[5px]">
                            <a href="artikel-detil?id=<?php echo htmlspecialchars($article['id']); ?>" class="block">
                                <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
                            </a>
                        </div>
                        <div>
                            <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary"> <?php echo htmlspecialchars($article['created_at']); ?> </span>
                            <h3>
                                <a href="artikel-detil?id=<?php echo htmlspecialchars($article['id']); ?>" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo htmlspecialchars($article['title']); ?> </a>
                            </h3>
                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">
                                <?php
                                $content = htmlspecialchars_decode($article['content']);
                                if (strlen($content) > 100) {
                                    echo substr($content, 0, 100) . '... <a href="artikel-detil?id=' . htmlspecialchars($article['id']) . '" class="text-primary">baca lagi</a>';
                                } else {
                                    echo $content;
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-8 text-center wow fadeInUp" data-wow-delay=".2s">
                <div class="inline-flex p-3 bg-white dark:bg-dark-2 border rounded-[10px] border-stroke dark:border-dark-3">
                    <ul class="flex items-center -mx-1">
                        <?php if ($currentPage > 1): ?>
                        <li class="px-1">
                            <a href="?page=<?php echo $currentPage - 1; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
                                <span>
                                    <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">
                                        <path d="M7.12979 1.91389L7.1299 1.914L7.1344 1.90875C7.31476 1.69833 7.31528 1.36878 7.1047 1.15819C7.01062 1.06412 6.86296 1.00488 6.73613 1.00488C6.57736 1.00488 6.4537 1.07206 6.34569 1.18007L6.34564 1.18001L6.34229 1.18358L0.830207 7.06752C0.830152 7.06757 0.830098 7.06763 0.830043 7.06769C0.402311 7.52078 0.406126 8.26524 0.827473 8.73615L0.827439 8.73618L0.829982 8.73889L6.34248 14.6014L6.34243 14.6014L6.34569 14.6047C6.546 14.805 6.88221 14.8491 7.1047 14.6266C7.30447 14.4268 7.34883 14.0918 7.12833 13.8693L1.62078 8.01209C1.55579 7.93114 1.56859 7.82519 1.61408 7.7797L1.61413 7.77975L1.61729 7.77639L7.12979 1.91389Z" stroke-width="0.3" />
                                    </svg>
                                </span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="px-1">
                            <a href="?page=<?php echo $i; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary <?php echo ($i == $currentPage) ? 'hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                        <li class="px-1">
                            <a href="?page=<?php echo $currentPage + 1; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
                                <span>
                                    <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">
                                        <path d="M0.870212 13.0861L0.870097 13.086L0.865602 13.0912C0.685237 13.3017 0.684716 13.6312 0.895299 13.8418C0.989374 13.9359 1.13704 13.9951 1.26387 13.9951C1.42264 13.9951 1.5463 13.9279 1.65431 13.8199L1.65436 13.82L1.65771 13.8164L7.16979 7.93248C7.16985 7.93243 7.1699 7.93237 7.16996 7.93231C7.59769 7.47923 7.59387 6.73477 7.17253 6.26385L7.17256 6.26382L7.17002 6.26111L1.65752 0.398611L1.65757 0.398563L1.65431 0.395299C1.454 0.194997 1.11779 0.150934 0.895299 0.373424C0.695526 0.573197 0.651169 0.908167 0.871667 1.13067L6.37922 6.98791C6.4442 7.06886 6.43141 7.17481 6.38592 7.2203L6.38587 7.22025L6.38271 7.22361L0.870212 13.0861Z" stroke-width="0.3" />
                                    </svg>
                                </span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Blog Section End -->
    <?php include 'parsial/footer.php'; ?>
    <!-- ====== Footer Section End -->
    <!-- ====== Back To Top Start -->
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <!-- ====== Back To Top End -->
    <!-- ====== All Scripts -->
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
