<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/controllers/DonationController.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: ../login");
    exit();
}

$db = new Database();
$donationController = new DonationController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $donor_name = $_POST['donor_name'];
    $amount = $_POST['amount'];

    if ($id) {
        // Update
        try {
            $donationController->updateDonation($id, $donor_name, $amount);
            $success = "Donasi berhasil diperbarui!";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        // Create
        try {
            $donationController->createDonation($donor_name, $amount);
            $success = "Donasi berhasil dibuat!";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

if (isset($_GET['delete'])) {
    try {
        $donation_id = $_GET['delete'];
        $donationController->deleteDonation($donation_id);
        $success = "Donasi berhasil dihapus!";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
    header("Location: manage_donations.php");
    exit();
}

$donations = $donationController->getAllDonations();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Manage Donations - FK-PKPPS Ponpes</title>
    <?php include dirname(__DIR__) . '/parsial/meta.php'; ?>
</head>
<body>
<?php include dirname(__DIR__) . '/parsial/navbar.php'; ?>

<section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px] h-full">
    <div class="container px-4">            
        <div class="w-full px-4">
            <div class="mx-auto text-left bg-primary">
                <h2 class="mb-2.5 text-3xl font-bold text-white dark:text-white md:text-[18px] md:leading-[1.44]">
                    Manage Donations
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
                <a href="manage_donations.php?create=true" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">Buat Donasi Baru</a>
                <?php if (isset($_GET['create']) || isset($_GET['edit'])): ?>
                <form id="donationForm" action="manage_donations.php" method="post" class="bg-white bordered shadow-md rounded-md p-4 mt-4">
                    <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['edit']) ? htmlspecialchars($_GET['edit']) : ''; ?>">
                    <div class="mb-[22px]">
                        <label for="donor_name" class="block mb-4 text-sm text-body-color dark:text-dark-6">Nama Donatur</label>
                        <input type="text" name="donor_name" id="donor_name" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-[30px]">
                        <label for="amount" class="block mb-4 text-sm text-body-color dark:text-dark-6">Jumlah Donasi</label>
                        <input type="number" name="amount" id="amount" class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 resize-none border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
                    </div>
                    <div class="mb-0">
                        <button type="submit" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark"><?php echo isset($_GET['edit']) ? 'Update' : 'Buat'; ?> Donasi</button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="pb-10 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px] h-full">
    <div class="container mx-auto mt-4">
        <h2 class="text-xl font-semibold font-medium mt-8 py-8 text-dark dark:text-white">Seluruh Donasi</h2>
        <table class="table-auto w-full bg-white shadow-md rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Donatur</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $donation): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo $donation['id']; ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($donation['donor_name']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($donation['amount']); ?></td>
                    <td class="border px-4 py-2">
                        <a href="manage_donations.php?edit=<?php echo $donation['id']; ?>" class="text-dark rounded-md text-sm py-1 px-2 hover:bg-primary hover:opacity-70" style="background-color:#FFFF80;color:#1F2A37;">Ubah</a>
                        <a href="manage_donations.php?delete=<?php echo $donation['id']; ?>" class="text-dark rounded-md text-sm py-1 px-2 hover:bg-primary hover:opacity-70" style="background-color:#FF6161;color:#FFFFFF;">Hapus</a>
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
