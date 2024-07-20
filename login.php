<?php
session_start();
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/AuthController.php';
require_once 'modules/CSRF.php';
$db = new Database();
$authController = new AuthController($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (CSRF::validateToken($_POST['csrf_token'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($authController->login($email, $password)) {
            header("Location: /");
            exit();
        } else {
            $error = "Email atau password salah!";
        }
    } else {
        $error = "Invalid CSRF token!";
    }
} else {
    if ($authController->checkUserSession()) {
        header("Location: /");
        exit();
    }
}
$csrf_token = CSRF::generateToken();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Login - FK-PKPPS Ponpes</title>
    <?php include 'parsial/meta.php' ?>
</head>
<body>
    <?php include 'parsial/navbar.php'; ?>
    <!-- ====== BannerStart -->
    <div class="relative z-10 overflow-hidden pt-[120px] pb-[60px] md:pt-[130px] lg:pt-[160px] dark:bg-dark">
    <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-stroke/0 via-stroke dark:via-dark-3 to-stroke/0">
    </div>
    <div class="container">
        <div class="flex flex-wrap items-center -mx-4">
        <div class="w-full px-4">
            <div class="text-center">
            <h1 class="mb-4 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]">
                Selamat datang kembali</h1>
            <p class="mb-5 text-base text-body-color dark:text-dark-6">
                Jika Anda sudah punya akun sebelumnya silahkan masuk.
            </p>

            <ul class="flex items-center justify-center gap-[10px]">
                <li>
                <a href="<?php echo BASE_URL; ?>"
                    class="flex items-center gap-[10px] text-base font-medium text-dark dark:text-white">
                    Beranda
                </a>
                </li>
                <li>
                <a href="javascript:void(0)" class="flex items-center gap-[10px] text-base font-medium text-body-color">
                    <span class="text-body-color dark:text-dark-6"> / </span>
                    Login
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!-- ====== BannerEnd -->
    <!-- ====== FormsStart -->
    <section class="bg-[#F4F7FF] py-14 lg:py-20 dark:bg-dark h-full">
        <div class="container">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
            <div
                class="wow fadeInUp relative mx-auto max-w-[525px] overflow-hidden rounded-lg bg-white dark:bg-dark-2 py-14 px-8 text-center sm:px-12 md:px-[60px]"
                data-wow-delay=".15s">
                <div class="mb-10 text-center">
                <a href="javascript:void(0)" class="mx-auto inline-block max-w-[160px]">
                    <img src="<?php echo ASSETS_URL; ?>images/logo/masuk.png" alt="logo" class="dark:hidden" />
                    <img src="<?php echo ASSETS_URL; ?>images/logo/masuk-white.png" alt="logo" class="hidden dark:block" />
                </a>
                </div>
                <form action="login" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <div class="mb-[22px]">
                    <input type="email" name="email" id="email" placeholder="Email"
                    class="w-full px-5 py-3 text-base transition bg-transparent border rounded-md outline-none border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 placeholder:text-dark-6 focus:border-primary dark:focus:border-primary focus-visible:shadow-none" required/>
                </div>
                <div class="mb-[22px]">
                    <input type="password" name="password" id="password" placeholder="Password"
                    class="w-full px-5 py-3 text-base transition bg-transparent border rounded-md outline-none border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 placeholder:text-dark-6 focus:border-primary dark:focus:border-primary focus-visible:shadow-none" required/>
                </div>
                <span class="relative block text-center z-1 mb-7">
                <span class="absolute left-0 block w-full h-px -z-1 top-1/2 bg-stroke dark:bg-dark-3"></span>
                <span class="relative z-10 inline-block px-3 text-base bg-white dark:bg-dark-2 text-body-secondary">Proses Masuk Aplikasi</span>
                </span>
                <div class="mb-9">
                    <input type="submit" value="Masuk"
                    class="w-full px-5 py-3 text-base text-white transition duration-300 ease-in-out border rounded-md cursor-pointer border-primary bg-primary hover:bg-blue-dark" />
                </div>
                <?php if (isset($error)) { echo "<p class='text-red-500 mt-4'>$error</p>"; } ?>
                </form>
                <!--
                <a href="javascript:void(0)" class="inline-block mb-2 text-base text-dark dark:text-white hover:text-primary dark:hover:text-primary">
                Forget Password?
                </a>
                -->
                <p class="text-base text-body-secondary">
                Belum puny akun?
                <a href="<?php echo BASE_URL; ?>register" class="text-primary hover:underline">
                    Daftar
                </a>
                </p>
                <?php include 'parsial/svg-gallery.php' ?>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- ====== FormsEnd -->
    <?php include 'parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
