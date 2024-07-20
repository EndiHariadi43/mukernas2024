<?php
session_start();
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/EventController.php';
require_once 'controllers/EventParticipantController.php';

$db = new Database();
$eventController = new EventController($db);
$eventParticipantController = new EventParticipantController($db);
$eventId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($eventId !== null) {
    $mainEvent = $eventController->getEventById($eventId);
} else {
    $mainEvent = null;
}
$user_id = $_SESSION['user']['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['join_event'])) {
    if ($user_id) {
        $event_id = $_POST['event_id'];
        $eventParticipantController->addParticipant($event_id, $user_id);
    } else {
        header("Location: login.php");
        exit();
    }
}

$events = $eventController->getAllEvents();
if ($mainEvent !== null) {
    $events = array_filter($events, function($event) use ($eventId) {
        return $event['id'] !== $eventId;
    });
}
$perPage = 3;
$totalEvents = count($events);
$totalPages = ceil($totalEvents / $perPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));
$offset = ($currentPage - 1) * $perPage;
$eventsToShow = array_slice($events, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Kegiatan | FK-PKPPS</title>
    <?php include 'parsial/meta.php' ?>
</head>
<body>
    <?php include 'parsial/navbar.php'; ?>
    <!-- ====== BannerStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span>Kegiatan</span>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Anda harus login terlebih dahulu untuk dapat mengikuti dan mendaftar sebagai peserta kegiatan. </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== BannerEnd -->
    <!-- ====== BlogStart -->
    <section id="utama" class="pb-20 mb-90 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px] h-full">
      <div class="container">
        <?php if ($mainEvent): ?>
        <div class="flex flex-wrap justify-center -mx-4">
          <div class="w-full px-4">
            <div class="wow fadeInUp relative z-20 mb-[50px] h-[300px] overflow-hidden rounded-[5px] md:h-[400px] lg:h-[500px]" data-wow-delay=".1s">
              <img src="<?php echo BASE_URL . htmlspecialchars($mainEvent['image']); ?>" alt="image" class="object-cover object-center w-full h-full" />
            </div>
            <div class="flex flex-wrap -mx-4">
              <div class="w-full px-4 lg:w-8/12">
                <div>
                  <h2 class="wow fadeInUp mb-8 text-2xl font-bold text-dark dark:text-white sm:text-3xl md:text-[35px] md:leading-[1.28]" data-wow-delay=".1s"> <?php echo htmlspecialchars($mainEvent['title']); ?> </h2>
                    <div class="wow fadeInUp relative z-10 mb-10 overflow-hidden rounded-[5px] bg-primary/5 px-6 py-8 text-left sm:p-10 md:px-[60px]" data-wow-delay=".1s">
                      <p class="mb-[18px] text-base font-medium leading-[28px] text-dark dark:text-white"> <?php echo substr(strip_tags(htmlspecialchars_decode($mainEvent['description'])), 0, 255); ?>...</p>
                    </div>
                  <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Lokasi Map </h3>
                    <!-- Map -->
                    <div class="flex flex-wrap items-center mb-12 -mx-4" id="map-<?php echo htmlspecialchars($mainEvent['id']); ?>" style="width: 100%; height: 300px;"></div>
                    <div class="w-full px-4">
                    <div class="mx-auto max-w-[570px] text-center">
                    <form action="kegiatan.php?id=<?php echo $mainEvent['id']; ?>" method="post">
                        <input type="hidden" name="event_id" value="<?php echo $mainEvent['id']; ?>">
                        <button type="submit" name="join_event" class="inline-block rounded-md border border-transparent bg-secondary px-7 py-3 text-base font-medium text-white transition hover:bg-[#0BB489]">Ikuti Kegiatan</button>
                    </form>
                    </div>
                    </div>
                </div>
              </div>
              <?php $event = $mainEvent; include 'parsial/svg-kegiatan.php'; ?>          
            </div>
          </div>
        </div>
        <?php endif; ?>
        <!-- lainnya -->
        <?php if ($mainEvent === null): ?>
        <section id="lainnya" class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark h-full">
          <div class="container">
            <div class="flex flex-wrap -mx-4">
              <?php foreach ($eventsToShow as $event): ?>
              <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="mb-10 wow fadeInUp group" data-wow-delay=".1s">
                  <div class="mb-8 overflow-hidden rounded-[5px]">
                    <a href="kegiatan.php?id=<?php echo $event['id']; ?>" class="block">
                      <img src="<?php echo BASE_URL . htmlspecialchars($event['image']); ?>" alt="Event Image" class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
                    </a>
                  </div>
                  <div>
                    <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary"> <?php echo EventController::formatTanggalIndonesia($event['start_date']); ?> </span>
                    <h3>
                      <a href="kegiatan.php?id=<?php echo $event['id']; ?>" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo htmlspecialchars($event['title']); ?> </a>
                    </h3>
                    <p class="max-w-[370px] text-base text-body-color dark:text-dark-6"> <?php echo substr(strip_tags(htmlspecialchars_decode($event['description'])), 0, 255); ?>...</p>
                    <div class="w-full px-4">
                    <div class="mx-auto max-w-[570px] text-center">
                    <form action="kegiatan.php?id=<?php echo $event['id']; ?>" method="post">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        <button type="submit" name="join_event" class="inline-block rounded-md border border-transparent bg-secondary px-7 py-3 text-base font-medium text-white transition hover:bg-[#0BB489]">Ikuti Kegiatan</button>
                    </form>
                    </div>
                    </div>
                  </div>
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
                    <a href="kegiatan.php?page=<?php echo $currentPage - 1; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
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
                    <a href="kegiatan.php?page=<?php echo $i; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md <?php echo $i == $currentPage ? 'bg-primary text-dark' : 'hover:border-primary hover:bg-primary text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white'; ?> h-[34px] w-[34px] border-stroke dark:border-dark-3"><?php echo $i; ?></a>
                  </li>
                  <?php endfor; ?>
                  <?php if ($currentPage < $totalPages): ?>
                  <li class="px-1">
                    <a href="kegiatan.php?page=<?php echo $currentPage + 1; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
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
        <?php endif; ?>
      </div>
    </section>
    <!-- ====== BlogEnd -->
    <?php include 'parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
    <script>
        function initMap(eventId, lat, lng) {
            var platform = new H.service.Platform({
                'apikey': 'jI_EZMZjPEPjhMlPe5sYM6zqWWcVOBf-nP7RJdMJoO0'
            });
            var defaultLayers = platform.createDefaultLayers();
            var map = new H.Map(
                document.getElementById('map-' + eventId),
                defaultLayers.vector.normal.map,
                {
                    zoom: 14,
                    center: { lat: lat, lng: lng }
                });
            var ui = H.ui.UI.createDefault(map, defaultLayers);
            var mapEvents = new H.mapevents.MapEvents(map);
            var behavior = new H.mapevents.Behavior(mapEvents);

            var marker = new H.map.Marker({lat: lat, lng: lng});
            map.addObject(marker);
        }

        document.addEventListener("DOMContentLoaded", function() {
            <?php if ($mainEvent): ?>
                <?php list($lat, $lng) = explode(',', htmlspecialchars($mainEvent['location'])); ?>
                initMap('<?php echo htmlspecialchars($mainEvent['id']); ?>', <?php echo $lat; ?>, <?php echo $lng; ?>);
            <?php endif; ?>
        });
    </script>
</body>
</html>
