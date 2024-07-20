<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/AuthController.php';
require_once dirname(__DIR__) . '/controllers/EventController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'Admin') {
    header("Location: <?php echo BASE_URL; ?>");
    exit();
}

$db = new Database();
$authController = new AuthController($db);
$eventController = new EventController($db);
$totalUsers = $authController->getTotalUsers();
$totalLogins = $authController->getTotalLogins();
$totalParticipants = $eventController->getTotalParticipants();
$messages = $authController->getMessages();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
      <title>Beranda | FK-PKPPS</title>
      <?php include dirname(__DIR__) . '/parsial/meta.php';?>
  </head>
<body>
    <?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>
    <!-- ====== CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span>Hai, SuperAdmin</span><br>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Kebijakan Privasi ini bertujuan untuk membantu Anda memahami informasi yang kami kumpulkan, alasan kami mengumpulkannya, dan cara untuk memperbarui, mengelola, mengekspor, dan menghapus informasi Anda. </p>
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
    <!-- ====== BlogStart -->
    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark">
      <div class="container">
        <div class="flex flex-wrap -mx-4">
          <div class="w-full px-4 md:w-1/2 lg:w-1/3">
            <div class="wow fadeInUp group text-center" data-wow-delay=".1s">
              <div>
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <a href="javascript:void(0)" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo $totalUsers; ?> </a>
                </h2>
                <p class="max-w-[370px] text-base text-center text-body-color dark:text-dark-6"> Pengguna yang Mendaftar </p>
              </div>
            </div>
          </div>
          <div class="w-full px-4 md:w-1/2 lg:w-1/3">
            <div class="wow fadeInUp group text-center" data-wow-delay=".1s">
              <div>
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <a href="javascript:void(0)" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo $totalLogins; ?> </a>
                </h2>
                <p class="max-w-[370px] text-base text-center text-body-color dark:text-dark-6"> Pengguna yang Login </p>
              </div>
            </div>
          </div>
          <div class="w-full px-4 md:w-1/2 lg:w-1/3">
            <div class="wow fadeInUp group text-center" data-wow-delay=".1s">
              <div>
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <a href="javascript:void(0)" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo $totalParticipants; ?> </a>
                </h2>
                <p class="max-w-[370px] text-base text-center text-body-color dark:text-dark-6"> Pengguna Mengikuti Kegiatan </p>
              </div>
            </div>
          </div> 
                   
        </div>        
      </div>
    </section>
    <!-- ====== BlogEnd -->
    <!-- ====== TableStart -->
      <section class="bg-white dark:bg-dark py-20 lg:py-[120px]">
        <div class="container mx-auto">
        <h2 class="text-xl font-semibold mb-4">Pesan dari Form Kontak</h2>
            <div class="flex flex-wrap -mx-4">
              <div class="w-full px-4">
                  <div class="max-w-full overflow-x-auto">
                  <?php if (count($messages) > 0): ?>
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="text-center text-white bg-primary">
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Nama Lengkap</th>
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Email</th>
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Telepon</th>
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Pesan</th>
                                <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-medium text-white lg:py-7 lg:px-4">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($message['full_name']); ?></td>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($message['email']); ?></td>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($message['phone']); ?></td>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo nl2br(htmlspecialchars($message['message'])); ?></td>
                                    <td class="text-dark border-b border-l border-[#E8E8E8] bg-[#F3F6FF] dark:bg-dark-3 dark:border-dark dark:text-dark-7 py-5 px-2 text-center text-base font-medium"><?php echo htmlspecialchars($message['created_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Belum ada pesan apapun.</p>
                <?php endif; ?>
            </div>
      </div>
    </section>
    <?php include dirname(__DIR__) . '/parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
