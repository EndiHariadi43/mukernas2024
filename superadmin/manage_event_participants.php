<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/EventController.php';
require_once dirname(__DIR__) . '/controllers/EventParticipantController.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: /");
    exit();
}
if (!isset($_GET['event_id'])) {
    echo "Event ID is missing.";
    exit();
}
$db = new Database();
$eventController = new EventController($db);
$eventParticipantController = new EventParticipantController($db);
$event_id = $_GET['event_id'];
$participants = $eventParticipantController->getParticipantsByEventId($event_id);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Manage Event Participants</title>
    <?php include dirname(__DIR__) . '/parsial/meta.php';?>
</head>
<body>
    <?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>
    <!-- ====== CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px] h-full">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span class="text-3xl font-normal md:text-[40px]"> Daftar Peserta Kegiatan </span>
                </h2>
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
    <section class="bg-white dark:bg-dark py-20 lg:py-[120px] h-full">
    <div class="container mx-auto">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-center text-white bg-primary">
                            <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">ID</th>
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Nama</th>
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Email</th>
                            </tr>
                    </thead>
                        <tbody>
                            <?php foreach ($participants as $participant): ?>
                                <tr>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($participant['id']); ?></td>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($participant['name']); ?></td>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($participant['email']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- ====== BlogEnd -->
    <?php include dirname(__DIR__) . '/parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
