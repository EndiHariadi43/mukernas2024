<?php
session_start();
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/AuthController.php';
$db = new Database();
$authController = new AuthController($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'Client';

    try {
        if ($authController->register($name, $email, $password, $role)) {
            header("Location: login");
        } else {
            $error = "Registrasi gagal!";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Register - FK-PKPPS Ponpes</title>
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
                ٱلسَّلَامُ عَلَيْكُمْ</h1>
            <p class="mb-5 text-base text-body-color dark:text-dark-6">
                Buat akun baru untuk bergabung dengan FK-PKPPS.
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
                    Mendaftar
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
    <section class="bg-[#F4F7FF] py-14 lg:py-[90px] dark:bg-dark h-full">
        <div class="container">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
            <div
                class="wow fadeInUp relative mx-auto max-w-[525px] overflow-hidden rounded-xl shadow-form bg-white dark:bg-dark-2 py-14 px-8 text-center sm:px-12 md:px-[60px]"
                data-wow-delay=".15s">
                <div class="mb-10 text-center">
                <a href="javascript:void(0)" class="mx-auto inline-block max-w-[160px]">
                    <img src="<?php echo ASSETS_URL; ?>images/logo/daftar.png" alt="logo" class="dark:hidden" />
                    <img src="<?php echo ASSETS_URL; ?>images/logo/daftar-white.png" alt="logo" class="hidden dark:block" />
                </a>
                </div>
                <form action="register" method="post">
                <div class="mb-[22px]">
                    <input type="text" name="name" id="name" placeholder="Nama"
                    class="w-full px-5 py-3 text-base transition bg-transparent border rounded-md outline-none border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 placeholder:text-dark-6 focus:border-primary dark:focus:border-primary focus-visible:shadow-none" required/>
                </div>
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
                <span class="relative z-10 inline-block px-3 text-base bg-white dark:bg-dark-2 text-body-secondary">Proses membuat akun</span>
                </span>
                <div class="mb-9">
                    <input type="submit" value="Daftar"
                    class="w-full px-5 py-3 text-base text-white transition duration-300 ease-in-out border rounded-md cursor-pointer border-primary bg-primary hover:bg-blue-dark" />
                </div>
                <?php if (isset($error)) { echo "<p class='bg-dark text-white mb-4 mt-4'>$error</p>"; } ?>
                </form>

                <p class="mb-4 text-base text-body-secondary">
                Dengan membuat akun Anda setuju dengan<a href="<?php echo BASE_URL; ?>kebijakan_privasi" class="text-primary hover:underline"> Kebijakan Privasi</a> dan<a href="<?php echo BASE_URL; ?>persyaratan_layanan" class="text-primary hover:underline"> Ketentuan Layanan
                </a> kami.
                </p>
                <p class="text-base text-body-secondary">
                Sudah punya akun? <a href="<?php echo BASE_URL; ?>login" class="text-primary hover:underline">Masuk</a></p>

                <div>
                <span class="absolute top-1 right-1">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="1.39737" cy="38.6026" r="1.39737" transform="rotate(-90 1.39737 38.6026)"
                        fill="#3056D3" />
                    <circle cx="1.39737" cy="1.99122" r="1.39737" transform="rotate(-90 1.39737 1.99122)"
                        fill="#3056D3" />
                    <circle cx="13.6943" cy="38.6026" r="1.39737" transform="rotate(-90 13.6943 38.6026)"
                        fill="#3056D3" />
                    <circle cx="13.6943" cy="1.99122" r="1.39737" transform="rotate(-90 13.6943 1.99122)"
                        fill="#3056D3" />
                    <circle cx="25.9911" cy="38.6026" r="1.39737" transform="rotate(-90 25.9911 38.6026)"
                        fill="#3056D3" />
                    <circle cx="25.9911" cy="1.99122" r="1.39737" transform="rotate(-90 25.9911 1.99122)"
                        fill="#3056D3" />
                    <circle cx="38.288" cy="38.6026" r="1.39737" transform="rotate(-90 38.288 38.6026)" fill="#3056D3" />
                    <circle cx="38.288" cy="1.99122" r="1.39737" transform="rotate(-90 38.288 1.99122)" fill="#3056D3" />
                    <circle cx="1.39737" cy="26.3057" r="1.39737" transform="rotate(-90 1.39737 26.3057)"
                        fill="#3056D3" />
                    <circle cx="13.6943" cy="26.3057" r="1.39737" transform="rotate(-90 13.6943 26.3057)"
                        fill="#3056D3" />
                    <circle cx="25.9911" cy="26.3057" r="1.39737" transform="rotate(-90 25.9911 26.3057)"
                        fill="#3056D3" />
                    <circle cx="38.288" cy="26.3057" r="1.39737" transform="rotate(-90 38.288 26.3057)" fill="#3056D3" />
                    <circle cx="1.39737" cy="14.0086" r="1.39737" transform="rotate(-90 1.39737 14.0086)"
                        fill="#3056D3" />
                    <circle cx="13.6943" cy="14.0086" r="1.39737" transform="rotate(-90 13.6943 14.0086)"
                        fill="#3056D3" />
                    <circle cx="25.9911" cy="14.0086" r="1.39737" transform="rotate(-90 25.9911 14.0086)"
                        fill="#3056D3" />
                    <circle cx="38.288" cy="14.0086" r="1.39737" transform="rotate(-90 38.288 14.0086)" fill="#3056D3" />
                    </svg>
                </span>
                <span class="absolute left-1 bottom-1">
                    <svg width="29" height="40" viewBox="0 0 29 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="2.288" cy="25.9912" r="1.39737" transform="rotate(-90 2.288 25.9912)" fill="#3056D3" />
                    <circle cx="14.5849" cy="25.9911" r="1.39737" transform="rotate(-90 14.5849 25.9911)"
                        fill="#3056D3" />
                    <circle cx="26.7216" cy="25.9911" r="1.39737" transform="rotate(-90 26.7216 25.9911)"
                        fill="#3056D3" />
                    <circle cx="2.288" cy="13.6944" r="1.39737" transform="rotate(-90 2.288 13.6944)" fill="#3056D3" />
                    <circle cx="14.5849" cy="13.6943" r="1.39737" transform="rotate(-90 14.5849 13.6943)"
                        fill="#3056D3" />
                    <circle cx="26.7216" cy="13.6943" r="1.39737" transform="rotate(-90 26.7216 13.6943)"
                        fill="#3056D3" />
                    <circle cx="2.288" cy="38.0087" r="1.39737" transform="rotate(-90 2.288 38.0087)" fill="#3056D3" />
                    <circle cx="2.288" cy="1.39739" r="1.39737" transform="rotate(-90 2.288 1.39739)" fill="#3056D3" />
                    <circle cx="14.5849" cy="38.0089" r="1.39737" transform="rotate(-90 14.5849 38.0089)"
                        fill="#3056D3" />
                    <circle cx="26.7216" cy="38.0089" r="1.39737" transform="rotate(-90 26.7216 38.0089)"
                        fill="#3056D3" />
                    <circle cx="14.5849" cy="1.39761" r="1.39737" transform="rotate(-90 14.5849 1.39761)"
                        fill="#3056D3" />
                    <circle cx="26.7216" cy="1.39761" r="1.39737" transform="rotate(-90 26.7216 1.39761)"
                        fill="#3056D3" />
                    </svg>
                </span>
                </div>
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
