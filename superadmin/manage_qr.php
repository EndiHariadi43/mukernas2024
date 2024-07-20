<?php
session_start();
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/modules/Database.php';
require_once dirname(__DIR__) . '/vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Zxing\QrReader;

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'SuperAdmin') {
    header("Location: /");
    exit();
}

$qrImagePath = null;
$qrDecodedText = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] === UPLOAD_ERR_OK) {
        $uploadedFilePath = $_FILES['qr_image']['tmp_name'];
        $qrcode = new QrReader($uploadedFilePath);
        $qrDecodedText = $qrcode->text();
    } else {
        $accountName = $_POST['account_name'];
        $accountNumber = $_POST['account_number'];
        $bankName = $_POST['bank_name'];
        $amount = $_POST['amount'];

        $qrContent = "Account Name: $accountName\nAccount Number: $accountNumber\nBank Name: $bankName\nAmount: $amount";
        $options = new QROptions([
            'version'    => 5,
            'eccLevel'   => QRCode::ECC_L,
            'scale'      => 10,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'imageBase64' => false,
        ]);
        $qrcode = new QRCode($options);
        $qrImagePath = '../assets/qr_codes/qr_code.png';
        $qrcode->render($qrContent, $qrImagePath);
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Manage QR Codes - FK-PKPPS Ponpes</title>
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
                  <span>Dibuang Sayang...</span>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Ini adalah halaman dibuang sayang. Pada awalnya untuk menghasilkan Kode QR Rekening namun sudah digantikan dengan fungsi Midtrans dan Scan QR langsung di halaman donasi tipe akun pengguna. </p>
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[18px] md:leading-[1.44]">
                  <span class="text-3xl font-normal md:text-[20px]"> Kode di halaman ini berfungsi dan dapat dikembangkan dimasa mendatang. </span>
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
    <section id="contact" class="relative py-20 md:py-[120px]">
        <div class="absolute top-0 left-0 -z-[1] w-full dark:bg-dark h-full"></div>
            <div class="container px-4">     
                <div class="w-auto px-4">
                    <div class="wow fadeInUp rounded-lg bg-white dark:bg-dark-2 py-10 px-8 shadow-testimonial dark:shadow-none sm:py-12 sm:px-10 md:p-[60px] lg:p-10 lg:py-12 lg:px-10 2xl:p-[60px]"
                        data-wow-delay=".2s">
                        <div class="container mx-auto mt-4">
                            <h2 class="text-xl font-semibold">Generate QR Code</h2>
                            <form action="manage_qr.php" method="post" class="bg-white shadow-md rounded-md p-4">
                            <div class="mb-[22px]">
                                <label for="account_name">Nama Akun Bank:</label>
                                <input type="text" name="account_name" id="account_name" class="border border-gray-300 rounded-md p-2 w-full" required>
                            </div>
                            <div class="mb-[22px]">
                                <label for="account_number" class="mt-4">Nomor Rekening:</label>
                                <input type="text" name="account_number" id="account_number" class="border border-gray-300 rounded-md p-2 w-full" required>
                            </div>
                            <div class="mb-[22px]">
                                <label for="bank_name" class="mt-4">Nama Bank:</label>
                                <input type="text" name="bank_name" id="bank_name" class="border border-gray-300 rounded-md p-2 w-full" required>
                            </div>
                            <div class="mb-[22px]">
                                <label for="amount" class="mt-4">Jumlah:</label>
                                <input type="number" name="amount" id="amount" class="border border-gray-300 rounded-md p-2 w-full" required>
                            </div>
                            <div class="mb-0">
                                <button type="submit" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">
                                Hasilkan Kode QR
                                </button>
                            </div>
                            </form>
                            <?php if ($qrImagePath): ?>
                                <h2 class="text-xl font-semibold mt-8">Kode QR</h2>
                                <img src="<?php echo $qrImagePath; ?>" alt="Generated QR Code" class="mt-4">
                            <?php endif; ?>

                            <h2 class="text-xl font-semibold mt-8">Baca Kode QR</h2>
                            <form action="manage_qr.php" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-md p-4 mt-4">
                                <div class="mb-[22px]">
                                    <label for="qr_image">Upload Gambar Kode QR:</label>
                                    <input type="file" name="qr_image" id="qr_image" class="border border-gray-300 rounded-md p-2 w-full" required>
                                </div>
                                <div class="mb-0">
                                    <button type="submit" class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">
                                    Baca Kode QR
                                    </button>
                                </div>
                            </form>
                            <?php if ($qrDecodedText): ?>
                                <h2 class="text-xl font-semibold mt-8">Dekode Text Kode QR</h2>
                                <pre class="bg-gray-100 p-4 rounded-md mt-4"><?php echo htmlspecialchars($qrDecodedText); ?></pre>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
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
