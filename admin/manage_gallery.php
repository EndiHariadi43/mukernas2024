<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/GalleryController.php';

if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] != 'Admin' && $_SESSION['user']['role'] != 'Admin')) {
    header("Location: /");
    exit();
}

$db = new Database();
$galleryController = new GalleryController($db);

$limit = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['upload'])) {
        $event_id = $_POST['event_id'];
        $photos = $_FILES['photos'];
        $galleryController->uploadPhotos($event_id, $photos);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $galleryController->deletePhoto($id);
    }
    header("Location: manage_gallery.php");
    exit();
}

$photos = $galleryController->getPhotosByPage($limit, $offset);
$total_photos = $galleryController->getTotalPhotos();
$total_pages = ceil($total_photos / $limit);
$events = $galleryController->getAllEvents();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Galeri Kegiatan</title>
    <?php include dirname(__DIR__) . '/parsial/meta.php';?>
    <script src="https://kit.fontawesome.com/c152dc3e5c.js" crossorigin="anonymous"></script>
    <script>
      new WOW().init();
    </script>
    <style>
        .image-container {
            position: relative;
        }
        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 0, 0, 0.7);
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            z-index: 10;
        }
    </style>
</head>
<body>
<?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>
    <div class="relative z-10 overflow-hidden pt-[120px] pb-[60px] md:pt-[130px] lg:pt-[160px] dark:bg-dark">
        <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-stroke/0 via-stroke dark:via-dark-3 to-stroke/0"></div>
        <div class="container">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4">
                    <div class="text-center">
                        <h1 class="mb-4 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]">
                            Galeri Kegiatan
                        </h1>
                        <p class="mb-5 text-base text-body-color dark:text-dark-6">
                            Upload galeri kegiatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="contact" class="relative py-10 md:py-[100px]">
        <div class="absolute top-0 left-0 -z-[1] w-full dark:bg-dark h-full"></div>
        <div class="container px-4">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4 lg:w-6/12 xl:w-5/12">
                    <div class="wow fadeInUp rounded-lg bg-white dark:bg-dark-2 py-10 px-8 shadow-testimonial dark:shadow-none sm:py-12 sm:px-10 md:p-[60px] lg:p-10 lg:py-12 lg:px-10 2xl:p-[60px" data-wow-delay=".2s">
                        <h3 class="mb-8 text-2xl font-semibold md:text-[28px] md:leading-[1.42] text-dark dark:text-white">
                            Unggah Foto Kegiatan
                        </h3>
                        <form action="manage_gallery.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="upload" value="1">
                            <div class="mb-[22px]">
                                <label for="event_id" class="block mb-4 text-sm text-body-color dark:text-dark-6">Nama Kegiatan:</label>
                                <select name="event_id" id="event_id" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none">
                                    <option value="">Tidak ada</option>
                                    <?php foreach ($events as $event): ?>
                                        <option value="<?php echo $event['id']; ?>"><?php echo htmlspecialchars($event['title']) . ' - ' . htmlspecialchars($event['event_date']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-[22px]">
                                <label for="photos" class="block mb-4 text-sm text-body-color dark:text-dark-6">Foto:</label>
                                <input type="file" name="photos[]" id="photos" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" multiple required/>
                            </div>
                            <div class="mb-0">
                                <button type="submit" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">
                                    Upload Foto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 dark:bg-dark">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <?php foreach ($photos as $photo): ?>
                    <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                        <div class="mb-10 wow fadeInUp group image-container" data-wow-delay=".1s">
                            <div class="mb-8 overflow-hidden rounded-[5px] relative">
                                <h6>
                                    <a href="javascript:void(0)" class="inline-block text-xl font-semibold capitalize text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">
                                        <?php echo htmlspecialchars($photo['event_title']); ?>
                                    </a>
                                </h6>
                                <a href="javascript:void(0)" class="block">
                                    <img src="<?php echo htmlspecialchars($photo['photo']); ?>" alt="<?php echo htmlspecialchars($photo['event_title']); ?>" class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
                                <span class="inline-block px-2 py-0.5 mb-3 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">
                                    diupload pada: <?php echo htmlspecialchars($photo['uploaded_at']); ?>
                                </span>
                                </a>
                                <form action="manage_gallery.php" method="post" class="delete-button">
                                    <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">
                                    <button type="submit" name="delete" class="inline-flex items-center justify-center text-base font-medium text-white transition duration-300 ease-in-out rounded-sm hover:bg-red"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-8 text-center wow fadeInUp" data-wow-delay=".2s">
                <div class="inline-flex p-3 bg-white dark:bg-dark-2 border rounded-[10px] border-stroke dark:border-dark-3">
                    <ul class="flex items-center -mx-1">
                        <?php if ($page > 1): ?>
                            <li class="px-1">
                                <a href="?page=<?php echo $page - 1; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
                                    <span>
                                        <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">
                                            <path d="M7.12979 1.91389L7.1299 1.914L7.1344 1.90875C7.31476 1.69833 7.31528 1.36878 7.1047 1.15819C7.01062 1.06412 6.86296 1.00488 6.73613 1.00488C6.57736 1.00488 6.4537 1.07206 6.34569 1.18007L6.34564 1.18001L6.34229 1.18358L0.830207 7.06752C0.830152 7.06757 0.830098 7.06763 0.830043 7.06769C0.402311 7.52078 0.406126 8.26524 0.827473 8.73615L0.827439 8.73618L0.829982 8.73889L6.34248 14.6014L6.34243 14.6014L6.34569 14.6047C6.546 14.805 6.88221 14.8491 7.1047 14.6266C7.30447 14.4268 7.34883 14.0918 7.12833 13.8693L1.62078 8.01209C1.55579 7.93114 1.56859 7.82519 1.61408 7.7797L1.61413 7.77975L1.61729 7.77639L7.12979 1.91389Z" stroke-width="0.3" />
                                        </svg>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="px-1">
                                <a href="?page=<?php echo $i; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white <?php echo ($i == $page) ? 'bg-primary text-dark dark:text-white' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="px-1">
                                <a href="?page=<?php echo $page + 1; ?>" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">
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
    <!-- ====== BlogEnd -->
    <?php include dirname(__DIR__) . '/parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
