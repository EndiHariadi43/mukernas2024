<section id="about" class="bg-gray-1 pb-8 pt-20 dark:bg-dark-2 lg:pb-[70px] lg:pt-[120px]">
    <div class="container">
    <div class="wow fadeInUp" data-wow-delay=".2s">
        <div class="flex flex-wrap items-center -mx-4">
        <div class="w-full px-4 lg:w-1/2">
            <div class="mb-12 max-w-[540px] lg:mb-0">
            <h2 class="mb-5 text-3xl font-bold leading-tight text-dark dark:text-white sm:text-[40px] sm:leading-[1.2]"> Donasi </h2>
            <p class="mb-10 text-base leading-relaxed text-body-color dark:text-dark-6"> Berikan donasi Anda untuk mendukung kegiatan kita dimasa mendatang. <br> Scan Kode QR di bawah ini jika Anda tidak ingin menggunakan metode transfer donasi pihak ketiga</p>                
            <div class="inline-flex items-center justify-center py-1 text-base font-medium text-center text-white border rounded-sm border-primary bg-primary px-1 hover:border-blue-dark hover:bg-blue-dark">
                <img src="../assets/qr_codes/qr_code.png" alt="QR Code" class="w-80 h-80 rounded-full">
            </div>
            </div>
        </div>
        <div class="w-full px-4 pb-7 lg:w-1/2">
        <div class="flex flex-wrap items-center -mx-4">
        <?php if (isset($success)): ?>
            <p class="text-green-500" style="background-color:#008D3D;padding: 25px;margin-bottom:30px;color:white;"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p class="text-red-500" style="background-color:#F3536B;padding: 25px;margin-bottom:30px;color:white;"><?php echo $error; ?></p>
        <?php endif; ?>
        </div>
            <div class="flex flex-wrap -mx-2 sm:-mx-4 lg:-mx-2 xl:-mx-4">
        <form action="donasi.php" method="post" id="payment-form">
            <div class="mb-[22px]">
            <label for="donor_name" class="block mb-4 text-sm text-body-color dark:text-dark-6">Nama Lengkap*</label>
            <input type="text" name="donor_name" id="donor_name" placeholder="Nama lengkap Anda"
                class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
            </div>
            <div class="mb-[22px]">
            <label for="amount" class="block mb-4 text-sm text-body-color dark:text-dark-6">Jumlah Donasi*</label>
            <input type="text" name="amount" id="donor_name" placeholder="120000"
                class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" required/>
            </div>
            <div class="mb-0">
            <button type="submit"
                class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark">
                Kirimkan
            </button>
            </div>
        </form>
        <?php if ($snapToken): ?>
            <script type="text/javascript">
                window.snap.pay('<?php echo $snapToken; ?>', {
                    onSuccess: function(result) {
                        alert("Pembayaran berhasil!");
                        console.log(result);
                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran.");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                        console.log(result);
                    },
                    onClose: function() {
                        alert("Anda menutup popup tanpa menyelesaikan pembayaran.");
                    }
                });
            </script>
        <?php endif; ?>
    </div>
    </div>
</section>