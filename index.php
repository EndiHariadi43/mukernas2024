<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/config.php';
require_once 'modules/Database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/ArticleController.php';
require_once 'controllers/EventController.php';
require_once 'controllers/DonationController.php';

$db = new Database();
$authController = new AuthController($db);
$articleController = new ArticleController($db);
$articles = $articleController->getAllArticles();
$eventController = new EventController($db);
$donationController = new DonationController($db);
$articleId = isset($_GET['id']) ? (int)$_GET['id'] : null;
if ($articleId === null) {
    $article = $articleController->getMostClickedArticle();
} else {
    $article = $articleController->getArticleById($articleId);
}

$articles = $articleController->getAllArticles();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
      <title>Beranda | FK-PKPPS</title>
      <?php include 'parsial/meta.php' ?>
  </head>
  <body>
    <?php include 'parsial/navbar.php'; ?>
    <!-- Hero Start -->
    <div id="home" class="relative overflow-hidden bg-primary pt-[120px] md:pt-[130px] lg:pt-[160px]">
      <div class="container">
        <div class="-mx-4 flex flex-wrap items-center">
          <div class="w-full px-4">
            <div class="hero-content wow fadeInUp mx-auto max-w-[880px] text-center" data-wow-delay=".2s">
              <h1 class="mb-6 text-3xl font-bold leading-snug text-white sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]"> Musyawarah Besar Nasional 2024 </h1>
              <p class="mx-auto mb-9 max-w-[600px] text-base font-medium text-white sm:text-lg sm:leading-[1.44]"> Forum Komunikasi Pendidikan Kesetaraan pada Pondok Pesantren Salafiyah. Membahas isu-isu penting dalam pendidikan kesetaraan. </p>
              <ul class="mb-10 flex flex-wrap items-center justify-center gap-5">
                <li>
                <a href="<?php echo BASE_URL; ?>donasi" class="inline-flex items-center justify-center rounded-md bg-white px-7 py-[14px] text-center text-base font-medium text-dark shadow-1 transition duration-300 ease-in-out hover:bg-gray-2 hover:text-body-color">Donasi</a>
                </li>
              </ul>              
            </div>
          </div>
          <div class="w-full px-4">
            <div class="wow fadeInUp relative z-10 mx-auto max-w-[845px]" data-wow-delay=".25s">
              <div class="mt-16">
                <img src="<?php echo ASSETS_URL; ?>images/hero/front.png" alt="musyawarah" class="mx-auto max-w-full rounded-t-xl rounded-tr-xl" />
              </div>
              <?php include 'parsial/svg-hero.php'; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- HeroEnd -->
    <!-- Kegiatan Start -->
    <section class="bg-white pb-10 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px] h-full">
      <div class="container mx-auto">
        <div class="-mx-4 flex flex-wrap justify-center">
          <div class="w-full px-4">
            <div class="mx-auto mb-[60px] max-w-[485px] text-center">
              <span class="mb-2 block text-lg font-semibold text-primary"> Kegiatan FK-PKPPS </span>
              <h2 class="mb-4 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]"> Kegiatan </h2>
              <p class="text-base text-body-color dark:text-dark-6"> Login terlebih dahulu untuk dapat mengikuti kegiatan. </p>
            </div>
          </div>
        </div>
        <div class="-mx-4 flex flex-wrap">
          <?php
          $events = $eventController->getAllEvents();
          foreach ($events as $event) {
            echo "<div class='w-full px-4 md:w-1/2 lg:w-1/3'>";
            echo "<div class='wow fadeInUp group mb-10' data-wow-delay='.1s'>";
            echo "<div class='mb-8 overflow-hidden rounded-[5px]'>";
            echo "<a href='kegiatan.php?id=" . htmlspecialchars($event['id']) . "' class='block'>";
            echo "<img src='" . BASE_URL . "/" . htmlspecialchars($event['image']) . "' alt='Event Image' class='w-full transition group-hover:rotate-6 group-hover:scale-125' />";
            echo "</a>";
            echo "</div>";
            echo "<div class='text-body-color dark:text-dark-6'>";
            echo "<span class='mb-6 inline-block rounded-[5px] bg-primary px-4 py-0.5 text-center text-xs font-medium leading-loose text-white'>" . EventController::formatTanggalIndonesia($event['start_date']) . "</span>";
            echo "<h3>";
            echo "<a href='kegiatan.php?id=" . htmlspecialchars($event['id']) . "' class='mb-4 inline-block text-xl font-semibold text-dark hover:text-primary dark:text-white dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl'>" . htmlspecialchars($event['title']) . "</a>";
            echo "</h3>";
            echo "<p class='max-w-[370px] text-xs text-body-color dark:text-dark-6 mt-4'>" . html_entity_decode($event['description']) . "</p>";
            echo "<p class='text-body-color dark:text-dark-6 mt-4 mb-2' style='color:#E6EBF0'>" . "</p>";
            echo "<p class='text-body-color dark:text-dark-6 mb-1'><strong>Mulai:</strong> " . EventController::formatTanggalIndonesia($event['start_date']) . "</p>";
            echo "<p class='text-body-color dark:text-dark-6 mb-1'><strong>Selesai:</strong> " . EventController::formatTanggalIndonesia($event['end_date']) . "</p>";
            echo "<p class='text-body-color dark:text-dark-6 mb-1'><strong>Alamat:</strong> " . htmlspecialchars($event['address']) . "</p>";
            echo "<p class='text-body-color dark:text-dark-6 mb-4'><strong>Lokasi:</strong> " . htmlspecialchars($event['location']) . "</p>";
            echo "<div id='map-" . htmlspecialchars($event['id']) . "' style='width: 100%; height: 200px;'></div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
    </section>
    <!-- KegiatanEnd -->
    <!-- BlogStart -->
    <section class="pb-10 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px] h-full">
      <div class="container">
          <div class="flex flex-wrap justify-center -mx-4">
              <div class="w-full px-4">
                  <?php if ($article): ?>
                  <div class="wow fadeInUp relative z-20 mb-[50px] h-[300px] overflow-hidden rounded-[5px] md:h-[400px] lg:h-[500px]" data-wow-delay=".1s">
                      <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="image" class="object-cover object-center w-full h-full" />
                      <div class="absolute top-0 left-0 z-10 flex items-end w-full h-full bg-gradient-to-t from-dark-700 to-transparent">
                          <div class="flex flex-wrap items-center p-4 pb-4 sm:px-8">
                              <div class="flex items-center mb-4 mr-5 md:mr-10">
                                  <div class="w-10 h-10 mr-4 overflow-hidden rounded-full">
                                      <img src="<?php echo isset($_SESSION['user']['profile_pic']) && $_SESSION['user']['profile_pic'] != '' ? BASE_URL . htmlspecialchars($_SESSION['user']['profile_pic']) : ASSETS_URL . 'uploads/foto_default.svg'; ?>" alt="profile_pic" class="w-full" />
                                  </div>
                                  <p class="text-base font-medium text-white"> By <a href="javascript:void(0)" class="text-white hover:opacity-70"> <?php echo htmlspecialchars($article['author']); ?> </a></p>
                              </div>
                              <div class="flex items-center mb-4">
                                  <p class="flex items-center mr-5 text-sm font-medium text-white md:mr-6">
                                      <span class="mr-3">
                                          <?php include 'parsial/ikon-kalender.php';?>
                                      </span> Dibuat: <?php echo htmlspecialchars($article['created_at']); ?>
                                  </p>
                                  <p class="flex items-center text-sm font-medium text-white">
                                      <span class="mr-3">
                                          <?php include 'parsial/ikon-kalender.php';?>
                                      </span> Diupdate: <?php echo htmlspecialchars($article['updated_at']); ?>
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <?php else: ?>
                  <p class="text-center text-xl text-body-color dark:text-dark-6">Artikel tidak ditemukan.</p>
                  <?php endif; ?>
              </div>
          </div>

          <div class="flex flex-wrap -mx-4">
              <div class="w-full px-4 lg:w-8/12">
                  <div>
                      <?php if ($article): ?>
                      <h2 class="wow fadeInUp mb-8 text-2xl font-bold text-dark dark:text-white sm:text-3xl md:text-[35px] md:leading-[1.28]" data-wow-delay=".1s"> <?php echo htmlspecialchars($article['title']); ?> </h2>
                      <div class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> 
                          <?php echo htmlspecialchars_decode($article['content']); ?> 
                      </div>
                      <?php endif; ?>
                      <div class="flex flex-wrap items-center mb-12 -mx-4">
                          <div class="w-full px-4 md:w-1/2">
                          </div>
                          <div class="w-full px-4 md:w-1/2">
                              <div class="flex items-center wow fadeInUp md:justify-end" data-wow-delay=".1s">
                                  <span class="mr-5 text-sm font-medium text-body-color dark:text-dark-6"> Bagikan </span>
                                  <div class="flex items-center gap-[10px]">
                                      <?php include 'parsial/svg-fb.php';?>
                                      <?php include 'parsial/svg-twitter.php';?>
                                      <?php include 'parsial/svg-linkedin.php';?>                          
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="w-full px-4 lg:w-4/12">
                  <div>
                      <div class="wow fadeInUp relative mb-12 overflow-hidden rounded-[5px] bg-primary px-11 py-[60px] text-center lg:px-8" data-wow-delay=".1s">
                          <h3 class="mb-[6px] text-[28px] font-semibold leading-[40px] text-white"> Berita dan Artikel </h3>
                          <div>
                              <span class="absolute top-0 right-0">
                                  <?php include 'parsial/agenda-titik-atas-kanan.php'; ?>
                              </span>
                              <span class="absolute bottom-0 left-0">
                                  <?php include 'parsial/agenda-titik-bawah-kiri.php'; ?>
                              </span>
                          </div>
                      </div>

                      <div class="flex flex-wrap mb-8 -mx-4">
                          <div class="w-full px-4">
                              <h2 class="wow fadeInUp relative pb-5 text-2xl font-semibold text-dark dark:text-white sm:text-[28px]" data-wow-delay=".1s">Artikel Populer</h2>
                              <span class="mb-10 inline-block h-[2px] w-20 bg-primary"></span>
                          </div>
                          <?php foreach ($articles as $popularArticle): ?>
                          <div class="w-full px-4 md:w-1/2 lg:w-full">
                              <div class="flex items-center w-full pb-5 mb-5 border-b wow fadeInUp border-stroke dark:border-dark-3" data-wow-delay=".1s">
                                  <div class="mr-5 h-20 w-full max-w-[80px] overflow-hidden rounded-full">
                                      <img src="<?php echo isset($_SESSION['user']['profile_pic']) && $_SESSION['user']['profile_pic'] != '' ? BASE_URL . htmlspecialchars($_SESSION['user']['profile_pic']) : ASSETS_URL . 'uploads/foto_default.svg'; ?>" alt="profile_pic" class="w-12 h-12 mx-auto px-2 py-2 overflow-hidden rounded-full" />
                                  </div>
                                  <div class="w-full">
                                      <h4>
                                          <a href="artikel.php?id=<?= $popularArticle['id']; ?>" class="inline-block mb-1 text-lg font-medium leading-snug text-dark hover:text-primary dark:text-dark-6 dark:hover:text-primary lg:text-base xl:text-lg"><?= htmlspecialchars($popularArticle['title']); ?></a>
                                      </h4>
                                      <p class="text-sm text-body-color dark:text-dark-6"><?= htmlspecialchars($popularArticle['author']); ?></p>
                                  </div>
                              </div>
                          </div>
                          <?php endforeach; ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
    <!-- BlogEnd -->
    <!-- CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span>Ikuti Kegiatan FK-PKPPS Kami</span>
                  <span class="text-3xl font-normal md:text-[40px]"> Kita mulai sekarang </span>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Buat akun dan Anda dapat mengikuti kegiatan yang tersedia. </p>
                <a href="kegiatan" class="inline-block rounded-md border border-transparent bg-secondary px-7 py-3 text-base font-medium text-white transition hover:bg-[#0BB489]"> Mulai </a>
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
    <!-- CTAEnd -->
    <?php include 'parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
  </body>
</html>
