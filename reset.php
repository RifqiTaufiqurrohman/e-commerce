<?php
session_start();
require 'koneksi/koneksi.php';

if (isset($_POST['cek_no'])) {
    $telepon = $_POST['telepon'];
    // Cek apakah nomor ada di database
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE telepon_pelanggan = '$telepon'");
    $telepon_ada = $ambil->num_rows;

    if ($telepon_ada == 1) {
        // Simpan nomor telepon ke session
        $_SESSION['telepon'] = $telepon;
        $_SESSION['kirim_otp'] = true; // Menampilkan form untuk kirim OTP
    } else {
        echo "<script>alert('Nomor WhatsApp tidak ditemukan');</script>";
    }
}

if (isset($_POST['request_otp'])) {
    $telepon = $_SESSION['telepon'];
    $otp = rand(100000, 999999);
    $expiry_time = date("Y-m-d H:i:s", time() + 60);

    // Simpan OTP ke database
    $koneksi->query("DELETE FROM otp WHERE nomor = '$telepon'"); // Hapus OTP lama jika ada
    $koneksi->query("INSERT INTO otp (nomor, otp, waktu) VALUES ('$telepon', '$otp', '$expiry_time')");

    // Kirim OTP ke WhatsApp menggunakan API
    $data = [
        'target' => $telepon,
        'message' => "No OTP ini Bersifat Rahasia:\n\n*" . $otp . "*\n\nJika Anda Tidak Merasa Mengirim OTP dari Aplikasi CR Hijup, Silahkan Abaikan Pesan ini",
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => [
            "Authorization: ", // Isi Token 
        ],
    ]);
    curl_exec($curl);
    curl_close($curl);

    $_SESSION['form_otp'] = true; // Menampilkan form konfirmasi OTP
    unset($_SESSION['kirim_otp']); // Hapus session kirim OTP
}

if (isset($_POST['cek_otp'])) {
    $otp_input = $_POST['otp']; // OTP yang dimasukkan
    $telepon = $_SESSION['telepon']; // Nomor telepon dari session

    // Periksa OTP di database
    $ambil = $koneksi->query("SELECT * FROM otp WHERE nomor = '$telepon' AND otp = '$otp_input'");
    $data_otp = $ambil->fetch_assoc();

    if ($data_otp) {
        $current_time = time();
        $expiry_time = strtotime($data_otp['waktu']);
        if ($current_time > $expiry_time) {
            // OTP kadaluwarsa, hapus semua session
            session_unset();
            session_destroy();
            echo "<script>alert('OTP telah kedaluwarsa, silakan request ulang OTP.');</script>";
            echo "<script>location='reset.php';</script>"; // Kembali ke halaman awal
        } else {
            $_SESSION['form_reset_password'] = true;
            unset($_SESSION['form_otp']);
            $koneksi->query("DELETE FROM otp WHERE nomor = '$telepon'"); // Hapus OTP setelah digunakan
        }
    } else {
        echo "<script>alert('OTP salah');</script>";
        $_SESSION['form_otp'] = true;
    }
}

if (isset($_POST['reset_password'])) {
    $telepon = $_SESSION['telepon'];
    $password = $_POST['password'];
    $konfirm_password = $_POST['konfirm_password'];

    // Validasi konfirmasi password
    if ($password !== $konfirm_password) {
        echo "<script>alert('Password harus sama!');</script>";
        $_SESSION['form_reset_password'] = true; // Tetap tampilkan form reset password
    } else {
        // Hash password baru
        $password_hash = sha1($password);

        // Update password di database
        $koneksi->query("UPDATE pelanggan SET password_pelanggan = '$password_hash' WHERE telepon_pelanggan = '$telepon'");

        // Hapus session untuk keamanan
        session_unset();
        session_destroy();

        echo "<script>alert('Password berhasil direset! Silahkan login.');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Daftar </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo1.png">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style2.css" rel="stylesheet">

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <!-- navbar -->
    <?php include 'include/navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center align-items-center" id="login">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Reset Password</h4>
                                <?php if (!isset($_SESSION['telepon'])): ?>
                                    <!-- Form untuk memasukkan nomor WhatsApp -->
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label><strong>No WhatsApp</strong></label>
                                            <input type="number" class="form-control" name="telepon"
                                                placeholder="Masukkan No WhatsApp" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="cek_no" class="btn btn-primary btn-block">Cek No
                                                WhatsApp</button>
                                        </div>
                                    </form>
                                <?php elseif (isset($_SESSION['kirim_otp']) && !isset($_SESSION['form_otp'])): ?>
                                    <!-- Form untuk meminta OTP -->
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label><strong>No WhatsApp</strong></label>
                                            <input type="number" class="form-control" name="telepon"
                                                value="<?= $_SESSION['telepon'] ?>" readonly>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="request_otp"
                                                class="btn btn-primary btn-block">Request OTP</button>
                                        </div>
                                    </form>
                                <?php elseif (isset($_SESSION['form_otp'])): ?>
                                    <!-- Form untuk konfirmasi OTP -->
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label><strong>Masukkan OTP</strong></label>
                                            <input type="number" class="form-control" name="otp" placeholder="Masukkan OTP"
                                                required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="cek_otp"
                                                class="btn btn-primary btn-block">Verifikasi OTP</button>
                                        </div>
                                    </form>
                                <?php elseif (isset($_SESSION['form_reset_password'])): ?>
                                    <!-- Form untuk reset password -->
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label><strong>Password Baru</strong></label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Masukkan Password Baru" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Konfirmasi Password</strong></label>
                                            <input type="password" class="form-control" name="konfirm_password"
                                                placeholder="Konfirmasi Password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="reset_password"
                                                class="btn btn-primary btn-block">Reset Password</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'include/footer.php' ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="assets/vendor/global/global.min.js"></script>
    <script src="assets/js/quixnav-init.js"></script>
    <script src="assets/js/custom.min.js"></script>

    <script src="assets/vendor/chartist/js/chartist.min.js"></script>

    <script src="assets/vendor/moment/moment.min.js"></script>
    <script src="assets/vendor/pg-calendar/js/pignose.calendar.min.js"></script>

    <!-- Vectormap -->
    <script src="assets/vendor/raphael/raphael.min.js"></script>
    <script src="assets/vendor/morris/morris.min.js"></script>


    <script src="assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="assets/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="assets/vendor/gaugeJS/dist/gauge.min.js"></script>

    <!-- Datatable -->
    <script src="assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins-init/datatables.init.js"></script>

    <!--  flot-chart js -->
    <script src="assets/vendor/flot/jquery.flot.js"></script>
    <script src="assets/vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="assets/js/dashboard/dashboard-2.js"></script>
    <!-- Circle progress -->

    <!-- sweet alert -->
    <script src="assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="assets/js/plugins-init/sweetalert.init.js"></script>

    <!-- style custom -->
    <script src="assets/js/main.js"></script>

    <script>
        function validasiForm() {
            var telepon = document.getElementById('telepon').value;
            var password = document.getElementById('password').value;
            var konfirmPassword = document.getElementById('konfirm_password').value;

            // Validasi panjang nomor telepon
            if (telepon.length > 14) {
                alert('Nomor telepon tidak boleh lebih dari 14 angka');
                return false;
            }

            // Validasi password dan konfirmasi password
            if (password !== konfirmPassword) {
                alert('Password harus sama!');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>