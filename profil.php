<?php
session_start();
require_once 'config.php';
require_once 'modules/Database.php';
require_once 'controllers/AuthController.php';
require_once 'modules/CSRF.php';
$db = new Database();
$authController = new AuthController($db);
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (CSRF::validateToken($_POST['csrf_token'])) {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'birth_place' => $_POST['birth_place'],
            'birth_date' => !empty($_POST['birth_date']) ? $_POST['birth_date'] : null,
            'institution' => $_POST['institution'],
            'institution_address' => $_POST['institution_address'],
            'sub_district' => $_POST['sub_district'],
            'district' => $_POST['district'],
            'city' => $_POST['city'],
            'province' => $_POST['province'],
            'short_notes' => $_POST['short_notes'],
            'phone_number' => $_POST['phone_number'],
            'profile_pic' => $user['profile_pic']
        ];

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/profile_pics/';
            $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);

            // pastikan direktori ada
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                $data['profile_pic'] = $uploadFile;
            } else {
                $error = 'Failed to upload profile picture.';
            }
        }

        if (empty($error)) {
            if ($authController->updateProfile($user['id'], $data)) {
                $_SESSION['user'] = $authController->getUserById($user['id']);
                $success = 'Profile updated successfully.';
            } else {
                $error = 'Failed to update profile.';
            }
        }
    } else {
        $error = 'Invalid CSRF token!';
    }
}

$csrf_token = CSRF::generateToken();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <title>Profile - FK-PKPPS Ponpes</title>
    <?php include 'parsial/meta.php' ?>
    <script>
        function toggleEdit() {
            const fields = document.querySelectorAll('.profile-field');
            fields.forEach(field => {
                const text = field.querySelector('.profile-text');
                const input = field.querySelector('.profile-input');
                if (text.style.display === 'none') {
                    text.style.display = 'block';
                    input.style.display = 'none';
                } else {
                    text.style.display = 'none';
                    input.style.display = 'block';
                }
            });
            document.getElementById('editButton').style.display = 'none';
            document.getElementById('saveButton').style.display = 'block';
        }
    </script>
</head>
<body>
    <?php include 'parsial/navbar.php'; ?>        
    <!-- CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span>Profil Anda</span>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Silahkan perbarui profil Anda </p>
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
    <!-- CTAEnd -->
    <!-- Profil -->
    <section class="bg-[#F4F7FF] py-14 lg:py-20 dark:bg-dark h-full">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4 pt-lg-2">
                    <div class="wow fadeInUp relative mx-auto max-w-[525px] overflow-hidden rounded-lg bg-white dark:bg-dark-2 py-14 px-8 text-center sm:px-12 md:px-[60px]"
                        data-wow-delay=".15s">
                        <?php if (isset($success)) { echo "<p class='text-green-500 mt-4'>$success</p>"; } ?>
                        <?php if (isset($error)) { echo "<p class='text-red-500 mt-4'>$error</p>"; } ?>
                        <?php if (!$user['is_verified']) { echo "<p class='text-red-500 mt-4'>Akun belum diverifikasi. <a href='resend_verification.php' class='text-blue-500 underline'>Kirim ulang email verifikasi</a></p>"; } ?>
                        <form action="profil.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            <div class="mb-[22px] profile-field mb-10 text-center">
                                <div class="profile-text mx-auto inline-block max-w-[160px]">
                                    <?php if ($user['profile_pic']) { ?>
                                        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" width="100">
                                    <?php } ?>
                                </div>
                                <input type="file" name="profile_pic" class="profile-input w-full px-5 py-3 text-base transition bg-transparent border rounded-md outline-none border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 placeholder:text-dark-6 focus:border-primary dark:focus:border-primary focus-visible:shadow-none" style="display: none;" />
                            </div>
                            <?php
                            $fields = [
                                'name' => ['label' => 'Name', 'placeholder' => 'nama Anda'],
                                'email' => ['label' => 'Email', 'placeholder' => 'email Anda'],
                                'username' => ['label' => 'Username', 'placeholder' => 'username Anda'],
                                'phone_number' => ['label' => 'Nomor HP', 'placeholder' => 'nomor hp'],
                                'birth_place' => ['label' => 'Tempat Lahir', 'placeholder' => 'tempat lahir Anda'],
                                'birth_date' => ['label' => 'Tanggal Lahir', 'placeholder' => 'hh/bb/tttt'],
                                'institution' => ['label' => 'Asal Lembaga Pesantren', 'placeholder' => 'asal lembaga pesantren'],
                                'institution_address' => ['label' => 'Alamat Pesantren', 'placeholder' => 'alamat pesantren'],
                                'sub_district' => ['label' => 'Kelurahan', 'placeholder' => 'kelurahan'],
                                'district' => ['label' => 'Kecamatan', 'placeholder' => 'kecamatan'],
                                'city' => ['label' => 'Kabupaten/Kota', 'placeholder' => 'kabupaten/kota'],
                                'province' => ['label' => 'Provinsi', 'placeholder' => 'provinsi'],
                                'short_notes' => ['label' => 'Catatan Singkat', 'placeholder' => 'catatan singkat']
                            ];
                            foreach ($fields as $key => $field) {
                                echo '<div class="mb-[22px] profile-field">';
                                echo '<label for="'.$key.'" class="block mb-4 text-sm text-body-color dark:text-dark-6">'.$field['label'].':</label>';
                                echo '<div class="profile-text">'.htmlspecialchars($user[$key] ?? '').'</div>';
                                echo '<input type="text" id="'.$key.'" name="'.$key.'" value="'.htmlspecialchars($user[$key] ?? '').'" placeholder="'.$field['placeholder'].'" class="profile-input w-full px-5 py-3 text-base transition bg-transparent border rounded-md outline-none border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 placeholder:text-dark-6 focus:border-primary dark:focus:border-primary focus-visible:shadow-none" style="display: none;" />';
                                echo '</div>';
                            }
                            ?>
                            <div class="mb-9 mt-8">
                                <button type="button" id="editButton" onclick="toggleEdit()" class="w-full px-5 py-3 text-base text-white transition duration-300 ease-in-out border rounded-md cursor-pointer border-primary bg-primary hover:bg-blue-dark">Perbarui Profil</button>
                                <input type="submit" id="saveButton" value="Simpan Profil" class="w-full px-5 py-3 text-base text-white transition duration-300 ease-in-out border rounded-md cursor-pointer border-primary bg-primary hover:bg-blue-dark" style="display: none;" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'parsial/footer.php'; ?>
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
        <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
</body>
</html>
