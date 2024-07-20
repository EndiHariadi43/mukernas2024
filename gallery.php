<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/modules/Database.php';
require_once __DIR__ . '/controllers/GalleryController.php';

$db = new Database();
$galleryController = new GalleryController($db);

// Set the number of photos per page
$photosPerPage = 12;

// Get the current page or set a default
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset for the query
$offset = ($currentPage - 1) * $photosPerPage;

// Get filter event title
$filterEvent = isset($_GET['event']) ? $_GET['event'] : '';

// Get the photos and total number of photos
$photos = $galleryController->getPhotosByPage($photosPerPage, $offset, $filterEvent);
$totalPhotos = $galleryController->getTotalPhotos($filterEvent);

// Get event titles for dropdown
$eventTitles = $galleryController->getAllEvents();

// Calculate total pages
$totalPages = ceil($totalPhotos / $photosPerPage);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
      <title>Galeri | FK-PKPPS</title>
      <?php include 'parsial/meta.php' ?>
  </head>
<body>
    <?php include 'parsial/navbar.php'; ?>
    <!-- ====== CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span class="text-3xl font-normal md:text-[40px]"> Galeri Kegiatan </span>
                </h2>
                <ul class="flex items-center justify-center gap-[10px]">
                    <li>
                    <a href="<?php echo BASE_URL; ?>" class="flex items-center text-white gap-[10px] text-base font-medium text-dark dark:text-white"> Beranda </a>
                    </li>
                    <li>
                    <a href="javascript:void(0)" class="flex items-center text-white gap-[10px] text-base font-medium text-body-color">
                        <span class="text-body-color text-white dark:text-dark-6"> / </span> Galeri </a>
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
    <!-- ====== CTAEnd -->
    <!-- GaleriStart -->
    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark h-full">
      <div class="container">
        <div class="mb-4">
          <form method="GET" action="">
            <label for="event">Filter Foto Kegiatan:</label>
            <select name="event" id="event" onchange="this.form.submit()">
              <option value="">Semua Foto</option>
              <?php foreach ($eventTitles as $event): ?>
                <option value="<?php echo htmlspecialchars($event['title']); ?>" <?php if ($filterEvent === $event['title']) echo 'selected'; ?>>
                  <?php echo htmlspecialchars($event['title']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </form>
        </div>
        <div class="flex flex-wrap -mx-2">
          <?php foreach ($photos as $photo): ?>
          <div class="w-full px-2 md:w-1/2 lg:w-1/3">
            <div class="mb-0.5 wow fadeInUp group" data-wow-delay=".1s">
              <span class="inline-block px-4 py-0.5 mb-2 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary"><?php echo htmlspecialchars($photo['event_title']); ?></span>
              <div class="mb-2 overflow-hidden rounded-[5px]">
                <a href="<?php echo htmlspecialchars($photo['photo']); ?>" class="block">
                  <img src="<?php echo htmlspecialchars($photo['photo']); ?>" alt="<?php echo htmlspecialchars($photo['event_title']); ?>" class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
                </a>
              </div>
              <span class="inline-block px-4 py-0.5 mb-2 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary"><?php echo htmlspecialchars($photo['event_date']); ?></span>
              <span class="inline-block px-4 py-0.5 mb-2 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary"><?php echo htmlspecialchars($photo['uploaded_at']); ?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <!-- Pag -->
        <div class="mt-8 text-center wow fadeInUp" data-wow-delay=".2s">
          <div class="inline-flex p-3 bg-white dark:bg-dark-2 border rounded-[10px] border-stroke dark:border-dark-3">
            <ul class="flex items-center -mx-1">
              <?php if ($currentPage > 1): ?>
              <li class="px-1">
                <a href="?page=<?php echo $currentPage - 1; ?>&event=<?php echo urlencode($filterEvent); ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
                  <span>&laquo; Previous</span>
                </a>
              </li>
              <?php endif; ?>
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li class="px-1">
                <a href="?page=<?php echo $i; ?>&event=<?php echo urlencode($filterEvent); ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
                  <?php echo $i; ?>
                </a>
              </li>
              <?php endfor; ?>
              <?php if ($currentPage < $totalPages): ?>
              <li class="px-1">
                <a href="?page=<?php echo $currentPage + 1; ?>&event=<?php echo urlencode($filterEvent); ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
                  <span>Next &raquo;</span>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- GaleriEnd -->
    <?php include 'parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
