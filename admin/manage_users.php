<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/modules/User.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'Admin') {
    header("Location: /");
    exit();
}
$db = new Database();
$userModule = new User($db);
$users = $userModule->getAllUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $userId = $_POST['user_id'];

    if ($action == 'delete') {
        $userModule->deleteUser($userId);
        header("Location: manage_users.php");
        exit();
    }
}
$filteredUsers = array_filter($users, function($user) {
    return $user['role'] !== 'SuperAdmin';
});
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Manage Users - FK-PKPPS</title>
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
                  <span>Hai, Admin</span><br>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Anda dapat memilih untuk menghapus dia dari status Admin. </p>
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
    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark">
      <div class="container">
      <p class="max-w-[370px] text-base text-body-color dark:text-dark-6 pb-10"> Daftar Akun Pengguna </p>
        <div class="flex flex-wrap -mx-4">
        <?php foreach ($filteredUsers as $user): ?>
          <div class="w-full px-4 md:w-1/3 lg:w-1/4">
            <div class="mb-10 wow fadeInUp group" data-wow-delay=".15s">
              <div>
                <h3>
                  <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl"> <?php echo htmlspecialchars($user['name']); ?> </a>
                </h3>
                <p class="max-w-[370px] text-base text-body-color dark:text-dark-6"> <?php echo htmlspecialchars($user['email']); ?></p>
                <p class="max-w-[370px] text-base text-body-color dark:text-dark-6"> Status Akun: <?php echo htmlspecialchars($user['role']); ?></p>
                <input type="hidden" name="user_id" value="<?php echo $admin['id']; ?>">
                    <form action="manage_users" method="post" class="mt-4">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="action" value="delete" class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">Hapus</button>
                    </form>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
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
