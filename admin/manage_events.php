<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/EventController.php';
require_once dirname(__DIR__) . '/modules/CSRF.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'Admin') {
    header("Location: ../login.php");
    exit();
}

$db = new Database();
$eventController = new EventController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (CSRF::validateToken($_POST['csrf_token'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $address = $_POST['address'];
        $location = $_POST['location'];
        $image = $_FILES['image'];
        $id = $_POST['id'] ?? null;

        try {
            if ($id) {
                // Update
                $eventController->updateEvent($id, $title, $description, $start_date, $end_date, $address, $location, $image);
                $success = "Kegiatan berhasil diperbarui!";
            } else {
                // Create
                $eventController->createEvent($title, $description, $start_date, $end_date, $address, $location, $image);
                $success = "Kegiatan berhasil dibuat!";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        header("Location: manage_events.php");
        exit();
    } else {
        $error = "Invalid CSRF token!";
    }
}

if (isset($_GET['delete'])) {
    try {
        $event_id = $_GET['delete'];
        $eventController->deleteEvent($event_id);
        $success = "Kegiatan berhasil dihapus!";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
    header("Location: manage_events.php");
    exit();
}

$events = $eventController->getAllEvents();
$csrf_token = CSRF::generateToken();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Manage Events - FK-PKPPS Ponpes</title>
    <?php include dirname(__DIR__) . '/parsial/meta.php'; ?>
</head>
<body>
<?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>

<section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
    <div class="container px-4">            
        <div class="w-full px-4">
            <div class="mx-auto text-left bg-primary">
                <h2 class="mb-2.5 text-3xl font-bold text-white dark:text-white md:text-[18px] md:leading-[1.44]">
                    <?php echo isset($_GET['edit']) ? 'Ubah Kegiatan' : 'Buat Kegiatan'; ?>
                </h2>
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
        <div class="w-full px-4">
            <div class="wow fadeInUp rounded-lg bg-transparent dark:bg-dark-2 py-10 px-8 dark:shadow-none sm:py-12 sm:px-10 md:p-[60px] lg:p-10 lg:py-12 lg:px-10 2xl:p-[60px]" data-wow-delay=".2s">
                <?php if ($success): ?>
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4"><?php echo $error; ?></div>
                <?php endif; ?>
                <a href="manage_events.php?buat=true" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">Buat Kegiatan Baru</a>
                <?php if (isset($_GET['buat']) || isset($_GET['edit'])): ?>
                <?php
                    $event = null;
                    if (isset($_GET['edit'])) {
                        $event = $eventController->getEventById($_GET['edit']);
                    }
                ?>
                <form id="eventForm" action="manage_events.php" method="post" enctype="multipart/form-data" class="bg-white bordered shadow-md rounded-md p-4 mt-4">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <input type="hidden" name="id" id="id" value="<?php echo $event['id'] ?? ''; ?>">
                    <input type="hidden" name="current_image" id="current_image" value="<?php echo $event['image'] ?? ''; ?>">
                    <div class="mb-[22px]">
                        <label for="title" class="block mb-4 text-sm text-body-color dark:text-dark-6">Nama Kegiatan</label>
                        <input type="text" name="title" id="title" value="<?php echo $event['title'] ?? ''; ?>" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-[30px]">
                        <label for="description" class="block mb-4 text-sm text-body-color dark:text-dark-6">Deskripsi</label>
                        <textarea name="description" id="description" rows="6" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 resize-none border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required><?php echo $event['description'] ?? ''; ?></textarea>
                    </div>
                    <div class="mb-[22px]">
                        <label for="start_date" class="block mb-4 text-sm text-body-color dark:text-dark-6">Tanggal Mulai</label>
                        <input type="datetime-local" name="start_date" id="start_date" value="<?php echo isset($event['start_date']) ? date('Y-m-d\TH:i', strtotime($event['start_date'])) : ''; ?>" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-[22px]">
                        <label for="end_date" class="block mb-4 text-sm text-body-color dark:text-dark-6">Tanggal Selesai</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="<?php echo isset($event['end_date']) ? date('Y-m-d\TH:i', strtotime($event['end_date'])) : ''; ?>" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-[22px]">
                        <label for="address" class="block mb-4 text-sm text-body-color dark:text-dark-6">Alamat Kegiatan</label>
                        <input type="text" name="address" id="address" value="<?php echo $event['address'] ?? ''; ?>" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-[22px]">
                        <label for="location" class="block mb-4 text-sm text-body-color dark:text-dark-6">Lokasi Kegiatan</label>
                        <input type="text" name="location" id="location" value="<?php echo $event['location'] ?? ''; ?>" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-[22px]">
                        <label for="image" class="block mb-4 text-sm text-body-color dark:text-dark-6">Gambar Kegiatan</label>
                        <input type="file" name="image" id="image" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none"/>
                        <?php if (isset($event['image'])): ?>
                            <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" class="w-20 h-20 object-cover mt-2">
                        <?php endif; ?>
                    </div>
                    <div class="mb-0">
                        <button type="submit" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark"><?php echo isset($_GET['edit']) ? 'Update' : 'Buat'; ?> Kegiatan</button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="pb-10 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px]">
    <div class="container mx-auto mt-4">
        <h2 class="text-xl font-semibold font-medium mt-8 py-8 text-dark dark:text-white">Seluruh Kegiatan</h2>
        <table class="table-auto w-full bg-white shadow-md rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Keg.</th>
                    <th class="px-4 py-2">Deskripsi</th>
                    <th class="px-4 py-2">Tanggal Mulai</th>
                    <th class="px-4 py-2">Tanggal Selesai</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Lokasi</th>
                    <th class="px-4 py-2">Gambar</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo $event['id']; ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($event['title']); ?></td>
                    <td class="border px-4 py-2"><div class="description"><?php echo htmlspecialchars_decode($event['description']); ?></div></td>
                    <td class="border px-4 py-2"><?php echo EventController::formatTanggalIndonesia($event['start_date']); ?></td>
                    <td class="border px-4 py-2"><?php echo EventController::formatTanggalIndonesia($event['end_date']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($event['address']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($event['location']); ?></td>
                    <td class="border px-4 py-2"><img src="<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" class="w-20 h-20 object-cover"></td>
                    <td class="border px-4 py-2">
                        <a href="manage_events.php?edit=<?php echo $event['id']; ?>" class="text-dark rounded-md text-sm py-1 px-2 hover:bg-primary hover:opacity-70" style="background-color:#FFFF80;color:#1F2A37;">Ubah</a>
                        <a href="manage_events.php?delete=<?php echo $event['id']; ?>" class="text-dark rounded-md text-sm py-1 px-2 hover:bg-primary hover:opacity-70" style="background-color:#FF6161;color:#FFFFFF;">Hapus</a>
                        <a href="manage_event_participants.php?event_id=<?php echo $event['id']; ?>" class="text-dark rounded-md text-sm py-1 px-2 hover:bg-primary hover:opacity-70" style="background-color:#1F2A37;color:#FFFFFF;">Peserta</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
