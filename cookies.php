<?php
session_start();

require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
      <title>Beranda | FK-PKPPS</title>
      <?php include 'parsial/meta.php' ?>
  </head>
    <body>
    <?php include 'parsial/navbar.php'; ?>
    <!-- ====== CTAStart -->
    <section class="relative z-10 overflow-hidden bg-primary py-20 lg:py-[115px]">
      <div class="container mx-auto">
        <div class="relative overflow-hidden">
          <div class="-mx-4 flex flex-wrap items-stretch">
            <div class="w-full px-4">
              <div class="mx-auto max-w-[570px] text-center">
                <h2 class="mb-2.5 text-3xl font-bold text-white md:text-[38px] md:leading-[1.44]">
                  <span>Cookies</span><br>
                  <span class="text-3xl font-normal md:text-[40px]"> Mengenal Cookie </span>
                </h2>
                <p class="mx-auto mb-6 max-w-[515px] text-base leading-[1.5] text-white"> Apa Itu Cookie ? </p>
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
    <section class="pb-10 px-4 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px] h-full h-full">
        <div class="container">
          <div class="flex flex-wrap justify-center -mx-4">
            <div class="w-full px-4">
              <div class="flex flex-wrap -mx-4">
                <div class="w-full">
                  <div>
                  <small class="mx-auto mb-6 max-w-[515px] text-base leading-[0.5] text-dark dark:text-dark-6">Terakhir diperbarui: 11 Juli 2024</small>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Dikenal juga sebagai cookie browser atau cookie pelacakan, cookie adalah file teks kecil, biasanya terenkripsi, yang terletak di direktori browser Anda. </p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Cookie digunakan oleh penerbit di Internet untuk membantu pengguna menjelajahi situs web dan menjalankan fungsi tertentu. Berkat peran utamanya dalam meningkatkan kegunaan atau fungsi situs, menonaktifkan cookie sepenuhnya dapat mencegah pengguna menggunakan situs web tertentu. </p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Beginilah cara beberapa situs mengetahui kapan Anda kembali dan membuat Anda tetap masuk, atau akan menampilkan halaman tertentu yang Anda sukai. Sering kali cookie dapat digunakan untuk menampilkan beberapa konten hanya sekali – misalnya popup atau pop-under atau iklan lain yang hanya ditampilkan saat pertama kali Anda mengunjungi situs dan tidak setiap kali Anda mengubah halaman atau mengunjungi kembali situs. </p>

                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Cookies adalah </h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Cookie dibuat saat browser Anda memuat situs web tertentu. Situs web tersebut mengirimkan informasi ke browser yang kemudian membuat berkas teks. Setiap kali pengguna kembali ke situs web yang sama, browser mengambil dan mengirimkan berkas ini ke server web. </p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Cookie dibuat tidak hanya oleh situs web yang sedang dijelajahi pengguna pada saat tertentu, tetapi juga oleh situs web lain yang menjalankan iklan, widget, atau elemen halaman lainnya. Cookie ini mengatur bagaimana iklan muncul atau bagaimana widget dan elemen lainnya berfungsi di halaman. </p>

                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Penggunaan standar untuk cookie browser </h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Situs web menyetel kuki untuk membantu mengautentikasi pengguna jika pengguna masuk ke area aman di situs web. Informasi atau kredensial login disimpan dalam kuki sehingga pengguna dapat masuk dan keluar dari situs web tanpa harus mengetik ulang informasi login yang sama berulang kali. </p>

                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Cookie Sesi </h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Cookie Sesi digunakan oleh server web untuk menyimpan informasi tentang aktivitas halaman pengguna sehingga pengguna dapat dengan mudah melanjutkan dari halaman server yang mereka tinggalkan. Tanpa menggunakan cookie tersebut, halaman web tidak dapat 'mengingat' di mana Anda berada pada kunjungan terakhir Anda – ini hanya dapat dilakukan dengan penggunaan cookie sesi. Cookie Sesi memberi tahu server halaman apa yang harus ditampilkan kepada pengguna sehingga pengguna tidak perlu mengingat di mana ia meninggalkannya atau mulai menavigasi situs dari awal lagi. Cookie Sesi berfungsi hampir seperti "penanda" saat digunakan di situs tersebut. Demikian pula, cookie dapat menyimpan informasi pemesanan yang diperlukan agar keranjang belanja berfungsi alih-alih memaksa pengguna untuk mengingat semua barang yang dimasukkan pengguna ke dalam keranjang belanja. Ini sangat berguna jika sistem Anda mengalami gangguan konektivitas atau komputer Anda 'macet' saat Anda sedang mengisi keranjang belanja. </p>

                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Cookie persisten atau pelacakan</h2>

                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Cookie Persisten menyimpan preferensi pengguna. Banyak situs web yang memungkinkan pengguna untuk menyesuaikan dengan tepat bagaimana informasi disajikan melalui tata letak atau tema situs. Penyesuaian ini membuat situs lebih mudah dinavigasi dan/atau memungkinkan pengguna meninggalkan sebagian "kepribadian" pengguna di situs. </p>

                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Masalah keamanan dan privasi cookie</h2>

                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Cookie BUKAN virus. Cookie menggunakan format teks biasa. Cookie bukanlah potongan kode yang dikompilasi sehingga tidak dapat dijalankan atau dijalankan sendiri. Oleh karena itu, cookie tidak dapat membuat salinan dirinya sendiri dan menyebar ke jaringan lain untuk dijalankan dan direplikasi lagi. Karena tidak dapat menjalankan fungsi-fungsi ini, cookie berada di luar definisi virus standar. </p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Namun, cookie BISA digunakan untuk tujuan jahat. Karena cookie menyimpan informasi tentang preferensi dan riwayat penelusuran pengguna, baik di situs tertentu maupun saat menjelajah di beberapa situs, cookie dapat digunakan sebagai bentuk spyware. </p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Cara pengembang web yang bertanggung jawab dan beretika menangani masalah privasi yang disebabkan oleh pelacakan kuki adalah dengan menyertakan deskripsi yang jelas tentang cara kuki diterapkan di situs mereka. Kebijakan Privasi Online berupaya membantu pengembang web menghasilkan informasi yang jelas dan mudah dipahami bagi penerbit web untuk disertakan di halaman web mereka. </p>

                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Penjelasan video Google tentang "Cookies"</h2>
                    <div class="container">
                      <div class="flex flex-wrap justify-center -mx-4">
                          <div class="w-full px-4 py-5">
                              <iframe width="560" height="315" src="https://www.youtube.com/embed/TBR-xtJVq7E?si=H7VjVN50uXEClSpX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                          </div>
                      </div>
                    </div>
                    <div class="flex flex-wrap items-center mb-12 -mx-4">
                      <div class="w-full px-4 md:w-1/2">
                        <div class="flex flex-wrap items-center gap-3 mb-8 wow fadeInUp md:mb-0" data-wow-delay=".1s">
                          <a href="javascript:void(0)" class="block rounded-md bg-primary/[0.08] px-[14px] py-[5px] text-base text-dark hover:bg-primary hover:text-white dark:text-white"> Cookies </a>
                          <a href="javascript:void(0)" class="block rounded-md bg-primary/[0.08] px-[14px] py-[5px] text-base text-dark hover:bg-primary hover:text-white dark:text-white"> Tool </a>
                          <a href="javascript:void(0)" class="block rounded-md bg-primary/[0.08] px-[14px] py-[5px] text-base text-dark hover:bg-primary hover:text-white dark:text-white"> Skrip Web </a>
                        </div>
                      </div>                    
                    </div>
                  </div>
                </div>              
              </div>
            </div>
          </div>        
      </section>
    <?php include 'parsial/footer.php'; ?>
    <!-- ====== BackToTopStart -->
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <!-- ====== BackToTopEnd -->
    <script src="<?php echo ASSETS_URL; ?>js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
  </body>
</html>