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
                  <span>Persyaratan Layanan</span>
                </h2>
                <div class="mx-auto max-w-[530px]">
                      <span class="mb-[14px] flex justify-center text-primary">
                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-current">
                          <path d="M13.7995 35.5781C12.937 35.5781 12.1464 35.075 11.8589 34.2844L9.48702 28.5344C6.82765 28.1031 4.45577 26.7375 2.9464 24.6531C1.36515 22.5687 0.862021 19.9812 1.5089 17.4656C2.51515 13.3687 6.75577 10.2781 11.4276 10.35C14.7339 10.4219 17.4651 11.7875 19.262 14.2312C20.987 16.675 21.4183 19.9812 20.412 23C19.4776 25.7312 18.2558 28.4625 17.1058 31.1219C16.6745 32.2 16.1714 33.2781 15.7401 34.2844C15.4526 35.075 14.662 35.5781 13.7995 35.5781ZM11.2839 13.5844C8.1214 13.5844 5.2464 15.5969 4.59952 18.2562C4.24015 19.8375 4.52765 21.4187 5.5339 22.7125C6.6839 24.2937 8.62452 25.3 10.7089 25.4437L11.7151 25.5156L13.7995 30.5469C13.8714 30.3312 14.0151 30.0437 14.087 29.8281C15.237 27.2406 16.387 24.5812 17.2495 21.9219C17.9683 19.9094 17.6808 17.6812 16.5308 16.1C15.3808 14.5187 13.5839 13.6562 11.3558 13.5844C11.3558 13.5844 11.3558 13.5844 11.2839 13.5844Z" />
                          <path d="M37.5905 35.65C36.728 35.65 35.9374 35.1469 35.6499 34.3563L33.278 28.6063C30.6187 28.175 28.2468 26.8094 26.7374 24.725C25.1562 22.6406 24.653 20.0531 25.2999 17.5375C26.3062 13.4406 30.5468 10.35 35.2187 10.4219C38.5249 10.4938 41.2562 11.8594 42.9812 14.3031C44.7062 16.7469 45.1374 20.0531 44.1312 23.0719C43.1968 25.8031 41.9749 28.5344 40.8249 31.1938C40.3937 32.2719 39.8905 33.35 39.4593 34.3563C39.2437 35.1469 38.453 35.65 37.5905 35.65ZM35.0749 13.5844C31.9124 13.5844 29.0374 15.5969 28.3905 18.2563C28.0312 19.8375 28.3187 21.4188 29.3249 22.7844C30.4749 24.3656 32.4155 25.3719 34.4999 25.5156L35.5062 25.5875L37.5905 30.6188C37.6624 30.4031 37.8062 30.1156 37.878 29.9C39.028 27.3125 40.178 24.6531 41.0405 21.9938C41.7593 19.9813 41.4718 17.7531 40.3218 16.1C39.1718 14.5188 37.3749 13.6563 35.1468 13.5844C35.1468 13.5844 35.1468 13.5844 35.0749 13.5844Z" />
                        </svg>
                      </span>
                      <p class="mb-[18px] text-base italic leading-[28px] text-white dark:text-white"> Kami tahu bahwa Anda mungkin ingin melewati Persyaratan Layanan ini, tetapi ini penting untuk menetapkan apa yang dapat Anda harapkan dari kami saat Anda menggunakan layanan FK-PKPPS, dan apa yang kami harapkan dari Anda. </p>
                    </div>
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
  <section class="pb-10 px-4 pt-20 dark:bg-dark lg:pb-20 lg:pt-[120px] h-full">
      <div class="container">
        <div class="flex flex-wrap justify-center -mx-4">
          <div class="w-full px-4">
            <div class="flex flex-wrap -mx-4">
              <div class="w-full">
                <div>
                <small class="mx-auto mb-6 max-w-[515px] text-base leading-[0.5] text-dark dark:text-dark-6">Terakhir diperbarui: 11 Juli 2024</small>
                  <h6 class="relative pb-5 text-2xl font-semibold text-dark dark:text-white sm:text-[36px]" data-wow-delay=".1s"> Selamat datang di FK-PKPPS! </h6>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Syarat dan ketentuan ini menguraikan aturan dan tata tertib penggunaan Situs Web FK-PKPPS, yang beralamat di https://fk-pkpps.ponpes.id. </p>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Dengan mengakses situs web ini, kami menganggap Anda menyetujui syarat dan ketentuan ini. Jangan terus menggunakan FK-PKPPS jika Anda tidak setuju untuk mematuhi semua syarat dan ketentuan yang tercantum di halaman ini. </p>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Terminologi berikut berlaku untuk Syarat dan Ketentuan, Pernyataan Privasi, dan Pemberitahuan Sanggahan ini, serta semua Perjanjian: "Klien", "Anda", dan "Milik Anda" merujuk kepada Anda, orang yang masuk ke situs web ini dan mematuhi syarat dan ketentuan Perusahaan. "Perusahaan", "Diri Kami", "Kami", "Milik Kami", dan "Kita", merujuk kepada Perusahaan kami. "Pihak", "Para Pihak", atau "Kita", merujuk kepada Klien dan kami sendiri. Semua istilah merujuk kepada penawaran, penerimaan, dan pertimbangan pembayaran yang diperlukan untuk melaksanakan proses bantuan kami kepada Klien dengan cara yang paling tepat untuk tujuan yang jelas dalam memenuhi kebutuhan Klien sehubungan dengan penyediaan layanan yang dinyatakan Perusahaan, sesuai dengan dan tunduk pada hukum yang berlaku di Belanda. Setiap penggunaan terminologi di atas atau kata-kata lain dalam bentuk tunggal, jamak, kapitalisasi, dan/atau dia/dia, dianggap dapat dipertukarkan dan karenanya merujuk kepada hal yang sama. Syarat dan Ketentuan kami dibuat dengan bantuan Generator Syarat & Ketentuan. </p>
                  <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Cookies </h3>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Kami menggunakan cookie. Dengan mengakses FK-PKPPS, Anda setuju untuk menggunakan cookie sesuai dengan Kebijakan Privasi FK-PKPPS. </p>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Sebagian besar situs web interaktif menggunakan cookie untuk memungkinkan kami mengambil detail pengguna pada setiap kunjungan. Cookie digunakan oleh situs web kami untuk mengaktifkan fungsionalitas area tertentu guna memudahkan orang mengunjungi situs web kami. Beberapa mitra afiliasi/iklan kami juga dapat menggunakan cookie. </p>
                  <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Lisensi </h3>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Kecuali dinyatakan lain, FK-PKPPS dan/atau pemberi lisensinya memiliki hak kekayaan intelektual atas seluruh materi di FK-PKPPS. Semua hak kekayaan intelektual dilindungi undang-undang. Anda dapat mengakses ini dari FK-PKPPS untuk penggunaan pribadi Anda dengan batasan yang diatur dalam syarat dan ketentuan ini.</p>
                  <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Anda tidak boleh:</p>
                  <div>
                    <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Memublikasikan ulang materi dari FK-PKPPS</li> 
                    <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Menjual, menyewakan atau mensublisensikan materi dari FK-PKPPS</li> 
                    <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Mereproduksi, menggandakan atau menyalin materi dari FK-PKPPS</li> 
                    <li class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Mendistribusikan ulang konten dari FK-PKPPS</li>
                  </div>                    
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Perjanjian ini akan dimulai pada tanggal perjanjian ini.</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Bagian dari situs web ini menawarkan kesempatan bagi pengguna untuk memposting dan bertukar pendapat dan informasi di area tertentu di situs web. FK-PKPPS tidak menyaring, mengedit, mempublikasikan atau meninjau Komentar sebelum kehadirannya di website. Komentar tidak mencerminkan pandangan dan pendapat FK-PKPPS, agen dan/atau afiliasinya. Komentar mencerminkan pandangan dan pendapat orang yang memposting pandangan dan pendapatnya. Sepanjang diizinkan oleh undang-undang yang berlaku, FK-PKPPS tidak bertanggung jawab atas Komentar atau atas tanggung jawab, kerusakan atau biaya apa pun yang disebabkan dan/atau diderita sebagai akibat dari penggunaan dan/atau pengeposan dan/atau tampilan Komentar. di situs web ini.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> FK-PKPPS berhak memantau seluruh Komentar dan menghapus Komentar apa pun yang dianggap tidak pantas, menyinggung, atau menyebabkan pelanggaran terhadap Syarat dan Ketentuan ini.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Anda menjamin dan menyatakan hal itu:</p>
                    <div>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Anda berhak memposting Komentar di situs web kami dan memiliki semua lisensi dan persetujuan yang diperlukan untuk melakukannya;</li> 
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Komentar tidak melanggar hak kekayaan intelektual apa pun, termasuk namun tidak terbatas pada hak cipta, paten, atau merek dagang pihak ketiga mana pun;</li> 
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Komentar tidak mengandung materi apa pun yang memfitnah, memfitnah, menyinggung, tidak senonoh, atau melanggar hukum yang merupakan pelanggaran privas</li> 
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Komentar tidak akan digunakan untuk meminta atau mempromosikan bisnis atau kebiasaan atau menampilkan aktivitas komersial atau aktivitas yang melanggar hukum.</li> 
                      <li class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Anda dengan ini memberi FK-PKPPS lisensi non-eksklusif untuk menggunakan, mereproduksi, mengedit, dan mengizinkan orang lain untuk menggunakan, mereproduksi, dan mengedit Komentar Anda dalam segala bentuk, format, atau media.</li>
                    </div>
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s"> Hyperlink ke Konten kami</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Organisasi berikut dapat membuat tautan ke Situs Web kami tanpa persetujuan tertulis sebelumnya:</p>
                    <div>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Lembaga pemerintah;</li> 
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Mesin pencari;</li> 
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Organisasi berita;</li> 
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Distributor direktori online dapat menautkan ke Situs Web kami dengan cara yang sama seperti mereka melakukan hyperlink ke Situs Web bisnis terdaftar lainnya; dan</li> 
                      <li class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Bisnis Terakreditasi di seluruh sistem kecuali yang meminta organisasi nirlaba, pusat perbelanjaan amal, dan kelompok penggalangan dana amal yang mungkin tidak memiliki hyperlink ke situs Web kami.</li>
                    </div>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Organisasi-organisasi ini boleh membuat tautan ke laman beranda kami, ke publikasi, atau ke informasi Situs Web lainnya selama tautan tersebut: (a) sama sekali tidak menipu; (b) tidak secara salah menyiratkan sponsorship, dukungan atau persetujuan dari pihak yang menghubungkan dan produk dan/atau layanannya; dan (c) sesuai dengan konteks situs pihak yang menghubungkan.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Kami dapat mempertimbangkan dan menyetujui permintaan tautan lain dari jenis organisasi berikut:</p>
                    <div>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">sumber informasi konsumen dan/atau bisnis yang umum dikenal;</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">situs komunitas dot.com;</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">asosiasi atau kelompok lain yang mewakili badan amal;</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">distributor direktori online;</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">portal internet;</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">perusahaan akuntansi, hukum dan konsultasi; dan</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">lembaga pendidikan dan asosiasi perdagangan.</li>
                    </div>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Kami akan menyetujui permintaan tautan dari organisasi-organisasi ini jika kami memutuskan bahwa: (a) tautan tersebut tidak akan membuat kami terlihat merugikan diri sendiri atau bisnis terakreditasi kami; (b) organisasi tidak memiliki catatan negatif apa pun pada kami; (c) manfaat bagi kami dari visibilitas hyperlink mengkompensasi ketidakhadiran FK-PKPPS; dan (d) kaitannya dalam konteks informasi sumber daya umum.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Organisasi-organisasi ini boleh membuat tautan ke laman beranda kami selama tautan tersebut: (a) sama sekali tidak menipu; (b) tidak secara salah menyiratkan sponsorship, dukungan atau persetujuan dari pihak yang menghubungkan dan produk atau layanannya; dan (c) sesuai dengan konteks situs pihak yang menghubungkan.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Jika Anda salah satu organisasi yang tercantum pada paragraf 2 di atas dan tertarik untuk menautkan ke website kami, Anda harus memberi tahu kami dengan mengirimkan email ke FK-PKPPS. Harap sertakan nama Anda, nama organisasi Anda, informasi kontak serta URL situs Anda, daftar URL apa pun yang ingin Anda tautkan ke Situs Web kami, dan daftar URL di situs kami yang ingin Anda tuju. tautan. Tunggu 2-3 minggu untuk mendapat tanggapan.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Organisasi yang disetujui dapat membuat hyperlink ke Situs Web kami sebagai berikut:</p>
                    <div>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Dengan menggunakan nama perusahaan kami; atau</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Dengan menggunakan pencari sumber daya seragam yang ditautkan; atau</li>
                      <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Dengan menggunakan deskripsi lain apa pun dari Situs Web kami yang ditautkan, hal tersebut masuk akal dalam konteks dan format konten di situs pihak yang menautkan.</li>
                    </div>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">Penggunaan logo FK-PKPPS atau karya seni lainnya tidak diperbolehkan untuk menghubungkan jika tidak ada perjanjian lisensi merek dagang.</p>
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">iFrames</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Tanpa persetujuan sebelumnya dan izin tertulis, Anda tidak boleh membuat bingkai di sekitar Halaman Web kami yang mengubah presentasi visual atau tampilan Situs Web kami dengan cara apa pun.</p>
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Tanggung Jawab Konten</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Kami tidak bertanggung jawab atas konten apa pun yang muncul di Situs Web Anda. Anda setuju untuk melindungi dan membela kami terhadap semua klaim yang muncul di Situs Web Anda. Tidak ada tautan yang boleh muncul di Situs Web mana pun yang dapat ditafsirkan sebagai memfitnah, tidak senonoh, atau kriminal, atau yang melanggar, melanggar, atau mendukung pelanggaran atau pelanggaran lainnya terhadap hak pihak ketiga mana pun.</p>
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Reservasi Hak</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Kami berhak meminta Anda menghapus semua tautan atau tautan tertentu apa pun ke Situs Web kami. Anda menyetujui untuk segera menghapus semua tautan ke Situs Web kami berdasarkan permintaan. Kami juga berhak mengubah syarat dan ketentuan ini serta kebijakan penautannya kapan saja. Dengan terus menautkan ke Situs Web kami, Anda setuju untuk terikat dan mengikuti syarat dan ketentuan tautan ini.</p>
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Penghapusan tautan dari situs web kami</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Jika Anda menemukan tautan apa pun di Situs Web kami yang menyinggung karena alasan apa pun, Anda bebas menghubungi dan memberi tahu kami kapan saja. Kami akan mempertimbangkan permintaan untuk menghapus tautan, namun kami tidak berkewajiban atau menanggapi Anda secara langsung.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Kami tidak memastikan bahwa informasi di situs ini benar, kami tidak menjamin kelengkapan atau keakuratannya; kami juga tidak berjanji untuk memastikan bahwa situs web tetap tersedia atau materi di situs web selalu diperbarui.</p>
                    <h3 class="wow fadeInUp mb-6 text-2xl font-semibold text-dark dark:text-white sm:text-[28px] sm:leading-[40px]" data-wow-delay=".1s">Penafian</h3>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Sejauh diizinkan oleh hukum yang berlaku, kami mengecualikan semua pernyataan, jaminan, dan ketentuan yang berkaitan dengan situs web kami dan penggunaan situs web ini. Tidak ada satu pun hal dalam penafian ini yang akan:</p>
                    <div>
                        <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">membatasi atau mengecualikan tanggung jawab kami atau Anda atas kematian atau cedera pribadi;</li>
                        <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">membatasi atau mengecualikan tanggung jawab kami atau Anda atas penipuan atau pernyataan keliru yang bersifat menipu;</li>
                        <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">membatasi tanggung jawab kami atau Anda dengan cara apa pun yang tidak diizinkan berdasarkan hukum yang berlaku; atau</li>
                        <li class="mb-2 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s">mengecualikan tanggung jawab kami atau Anda yang mungkin tidak dikecualikan berdasarkan hukum yang berlaku.</li>
                    </div>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Pembatasan dan larangan tanggung jawab yang diatur dalam Bagian ini dan bagian lain dalam penafian ini: (a) tunduk pada paragraf sebelumnya; dan (b) mengatur seluruh tanggung jawab yang timbul berdasarkan pelepasan tanggung jawab hukum, termasuk tanggung jawab yang timbul dalam kontrak, perbuatan melawan hukum, dan pelanggaran kewajiban hukum.</p>
                    <p class="mb-6 text-base wow fadeInUp text-body-color dark:text-dark-6" data-wow-delay=".1s"> Selama situs web dan informasi serta layanan di situs web disediakan secara gratis, kami tidak bertanggung jawab atas segala kehilangan atau kerusakan dalam bentuk apa pun.</p>
                  <div class="flex flex-wrap items-center mb-12 -mx-4">
                    <div class="w-full px-4 md:w-1/2">
                      <div class="flex flex-wrap items-center gap-3 mb-8 wow fadeInUp md:mb-0" data-wow-delay=".1s">
                        <a href="javascript:void(0)" class="block rounded-md bg-primary/[0.08] px-[14px] py-[5px] text-base text-dark hover:bg-primary hover:text-white dark:text-white"> Layanan </a>
                        <a href="javascript:void(0)" class="block rounded-md bg-primary/[0.08] px-[14px] py-[5px] text-base text-dark hover:bg-primary hover:text-white dark:text-white"> Persyaratan </a>
                        <a href="javascript:void(0)" class="block rounded-md bg-primary/[0.08] px-[14px] py-[5px] text-base text-dark hover:bg-primary hover:text-white dark:text-white"> Penggunaan </a>
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
    <a href="javascript:void(0)" class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
      <span class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"></span>
    </a>
    <script src="<?php echo ASSETS_URL; ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>assets/js/main.js"></script>
  </body>
</html>